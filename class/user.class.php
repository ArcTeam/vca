<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require ("db.class.php");
require ('mailer/autoload.php');
class User extends Db{
  function __construct(){}
  #NOTE: per accettare una richiesta di iscrizione, il server deve:
  #       1. controllare che la mail non sia di un utente già attivo
  #       2. controllare che la richiesta non sia già registrata (tabella "request")
  #       3. controllare se l'utente è già in rubrica (magari per una richiesta precedentemente rifiutata)
  public function subscribe($dati=array()){
    $tipo = $dati['tipo'];
    unset($dati['tipo']);
    #1. controllare che la mail non sia di un utente già attivo
    $isUser = $this->simple("select a.id from addr_book a, usr u where u.id=a.id and a.email='".$dati['email']."';");
    if (empty($isUser)) {
      #2. controllare che la richiesta non sia già registrata (tabella "request")
      $isRequest = $this->simple("select a.id,a.email from addr_book a, request r where r.address = a.id and a.email = '".$dati['email']."';");
      if (empty($isRequest)) {
        #3. controllare se l'utente è già in rubrica (magari per una richiesta precedentemente rifiutata)
        $isAddressBook = $this->simple("select id from addr_book a where a.id not in(select address from request) and a.id not in(select id from usr) and email = '".$dati['email']."';");
        if (empty($isAddressBook)) {
          #creo l'utente in rubrica e inserisco la richiesta in request
          return $this->addAddressBook($dati);
        }else {
          #inserisco la richiesta nella tabella request prendendo l'id da addr_book
          return array("code"=>2,"msg"=>$this->request($isAddressBook[0]['id']));
        }
      }else {
        return array("code"=>1,"msg"=>"<p>A request with email<br><strong>".$dati['email']."</strong><br>is already present.</p>");
      }
    }else {
      return array("code"=>1,"msg"=>"<p>An user with email<br><strong>".$dati['email']."</strong><br>is already present.<br>If you do not remember or you've lost your password you can ask for a new one on the server.</p><a href='rescuePwd.php' class='' title='request new password'>regenerate password</a>");
    }
  }

  private function admin($user=array()){
    $dati=$out=array();
    try {
      $dati['pwd']=$this->createPwd();
      $dati['id'] = $user['id'];
      $dati['class'] = 4;
      $out[]=$this->addUser($dati);
      $username=$this->getUsername($user['email']);
      $out[]=$this->sendMail(array($user['email'],$username,$dati['pwd'],"admin"));
      return implode("<br />",$out);
    } catch (Exception $e) {
      return "error: ".$e->getMessage()."\n".$e->getLine();
    }
  }

  private function request($id){
    try {
      $test = $this->simple("insert into request(address) values (".$id.")");
      return '<p>Ok, your request has been sent!</p><p id="countdowntimer" class="small"></p>';
    } catch (\PDOException $e) {
      return "error: ".$e->getMessage();
    }
  }

  private function addAddressBook($dati=array()){
    $campi=$val=$out=$user=array();
    foreach ($dati as $key => $value) {
      if (isset($value) && $value!=="") {
        $campi[]=":".$key;
        $val[$key]=$value;
      }
    }
    $sql = "insert into addr_book(".str_replace(":","",implode(",",$campi)).") values(".implode(",",$campi).");";
    $this->begin();
    try {
      $out[] = $this->prepared('',$sql,$val);
      $id = $this->pdo()->lastInsertId('addr_book_id_seq');
      if ($tipo=='admin') {
        $user['id'] = $id;
        $user['email'] = $dati['email'];
        $out[] = $this->admin($user);
      }else {
        $out[] = $this->request($id);
      }
      $this->commitTransaction();
      return array("code"=>2, "msg"=>implode("<br />",$out));
    } catch (\PDOException $e) {
      $this->rollback();
      return array("code"=>1,"msg"=>"<strong> error </strong><br>".end(str_replace(array('(', ')'), '', explode("=",end(explode(":",$out[0]))))));
    }
  }

  protected function addUser($dati=array()){
    $utente="insert into usr(id,pwd,class) values(:id,crypt(:pwd, gen_salt('bf',8)),:class);";
    return $this->prepared('nuovo utente',$utente,$dati);
  }

  public function updateAccount($dati=array()){
    $campi=$val=$out=array();
    foreach ($dati as $key => $value) {
      if (isset($value) && $value!=="") {
        $campi[]=$key."=:".$key;
        $val[$key]=$value;
      }
    }
    $sql = "update addr_book set ".implode(",",$campi)." where id=:id;";
    try {
      $out[]='success';
      $out[]=$this->prepared('modifica utente',$sql,$val);
      return $out;
    } catch (Exception $e) {
      return array('danger',$e->getMessage());
    }
  }
  public function rescuePwd($email){
    $checkEmail = $this->countRow("select id from addr_book where email = '".$email."';");
    $out=array();
    if ($checkEmail>0){
      $sql = "update usr set pwd=crypt(:pwd,gen_salt('bf',8)) where id=:id;";
      try {
        $this->begin();
        $dati['pwd']=$this->createPwd();
        $id=$this->simple("select id from addr_book where email = '".$email."';");
        $dati['id'] = $id[0]['id'];
        $out[]='success';
        $out[]=$this->prepared('nuova password',$sql,$dati);
        $username=$this->getUsername($email);
        $out[]=$this->sendMail(array($email,$username,$dati['pwd'],"password"));
        $this->commitTransaction();
        return $out;
      } catch (Exception $e) {
        $this->rollback();
        return array("danger",$e->getMessage());
      }
    }else{
      return array('danger','invalid or unknown email');
    }
  }
  public function changePwd($dati=array()){
    $check = $this->simple("select pwd from usr where id = ".$_SESSION['id']." and pwd = crypt('".$dati['oldpwd']."',pwd);");
    if (!empty($check)){
      $val = array('newpwd'=>$dati['newpwd'],'id'=>$_SESSION['id']);
      $sql = "update usr set pwd=crypt(:newpwd,gen_salt('bf',8)) where id=:id;";
      try {
        $this->prepared('',$sql,$val);
        return array('success','ok, password correctly updated');
      } catch (Exception $e) {
        return array('danger',$e->getMessage());
      }
    }else{
      return array('danger','error, old password is not correct, retry');
    }
  }

  public function login($dati=array()){ return $this->userExists($dati); }
  private function userExists($dati=array()){
    $sql="select a.id, a.email, u.pwd, u.class from addr_book a, usr u where u.id = a.id AND u.act = TRUE and a.email = '".$dati['email']."'";
    $row=$this->countRow($sql);
    if ($row>0){return $this->checkPwd($sql,$dati['pwd']);}else{return "1";}
  }

  private function checkPwd($sql,$pwd){
    $sql .= " and pwd = crypt('".$pwd."',pwd)";
    $utente=$this->simple($sql);
    if (!empty($utente)){
      return $this->setSession($utente);
    }else{
      return '2';
    }
  }
  private function setSession($utente){
    $username = $this->getUsername($utente[0]['email']);
    $_SESSION['username']=$username;
    $_SESSION['id']=$utente[0]['id'];
    $_SESSION['class']=$utente[0]['class'];
    return "3";
  }

  protected function getUsername($email){$u = explode("@",$email);return $u[0];}
  protected function createPwd(){
    $pwd = "";
    $pwdRand = array_merge(range('A','Z'), range('a','z'), range(0,9));
    for($i=0; $i < 10; $i++) {$pwd .= $pwdRand[array_rand($pwdRand)];}
    return $pwd;
  }
  ### sendMail function parameters:
  ### dati[0]=(char) email
  ### dati[1]=(char) username (use getUsername function)
  ### dati[2]=(char) clear password (use createPwd function)
  ### dati[3]=(char) email type(admin,user,password)
  protected function sendMail($dati=array()){
    $folder=$_SERVER['SERVER_NAME'];
    $mail = new PHPMailer(true);
    switch ($dati[3]) {
      case 'admin':
      $oggetto = 'New admin profile';
      $bodyFile = "initAdmin";
      break;
      case 'user':
        $oggetto = 'New account for Virtual Claudia Augusta data management system';
        $bodyFile = "newUsr";
        break;
      case 'password':
        $oggetto = 'Nuova password per il tuo account sul sistema di getsione della documentazione dei lavori di Arc-Team';
        $bodyFile = "newPwd";
        break;
    }
    $altBody = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/vca/mailBody/'.$bodyFile.'.txt');
    $altBody = str_replace('%utente%', $dati[1], $altBody);
    $altBody = str_replace('%password%', $dati[2], $altBody);
    $body = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/vca/mailBody/'.$bodyFile.'.html');
    $body = str_replace('%utente%', $dati[1], $body);
    $body = str_replace('%password%', $dati[2], $body);
    try {
      // $mail->SMTPDebug = 1;
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = getenv('ARCTEAMGMAIL');
      $mail->Password = getenv('ARCTEAMGMAILPWD');
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      //Recipients
      $mail->setFrom(getenv('ARCTEAMGMAIL'), 'Arc-Team');
      $mail->addAddress($dati[0],$dati[1]);
      // $mail->addBCC(getenv('ARCTEAMGMAIL'));
      $mail->addReplyTo(getenv('ARCTEAMGMAIL'), 'Arc-Team');
      //Content
      $mail->isHTML(true);
      $mail->Subject = $oggetto;
      $mail->Body    = $body;
      $mail->AltBody = $altBody;
      $mail->send();
      return "Password has been sent to the reference email. You can continue to use the new password or decide to change it after the first login.";
    } catch (Exception $e) {
      return "Errore nell&apos;invio della mail!<br/>Se di seguito visualizzi un messaggio di errore, copialo ed invialo all&apos;amministratore di sistema - beppenapo@arc-team.com<br/>: ".$mail->ErrorInfo;
    }
  }
}
?>
