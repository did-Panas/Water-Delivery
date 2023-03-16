<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	/*
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@example.com';                     //SMTP username
	$mail->Password   = 'secret';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	*/

	//От кого письмо
	$mail->setFrom('from@gmail.com', 'Форма замовлення'); // Указать нужный E-mail
	//Кому отправить
	$mail->addAddress('olegbash94@gmail.com'); // Указать нужный E-mail
	//Тема письма
	$mail->Subject = 'Форма замовлення води';

	//Тело письма
	$body = '<h1>Замовлення</h1>';

	if(trim(!empty($_POST['date']))){
		$body.='<p><strong>Дата:</strong> '.$_POST['date'].'</p>';
	}
	if(trim(!empty($_POST['time']))){
		$body.='<p><strong>Час:</strong> '.$_POST['time'].'</p>';
	}
	if(trim(!empty($_POST['not-call']))){
		$body.='<p><strong>Не телефонувати:</strong> '.$_POST['not-call'].'</p>';
	}
	if(trim(!empty($_POST['name-input']))){
		$body.='<p><strong>Імя:</strong> '.$_POST['name-input'].'</p>';
	}
	if(trim(!empty($_POST['flat-numb-input']))){
		$body.='<p><strong>Номер будинку:</strong> '.$_POST['flat-numb-input'].'</p>';
	}
	if(trim(!empty($_POST['phone-number']))){
		$body.='<p><strong>Телефон:</strong> '.$_POST['phone-number'].'</p>';
	}
	if(trim(!empty($_POST['email']))){
		$body.='<p><strong>Email:</strong> '.$_POST['email'].'</p>';
	}
	if(trim(!empty($_POST['comments']))){
		$body.='<p><strong>Коментарі:</strong> '.$_POST['comments'].'</p>';
	}
	if(trim(!empty($_POST['payment']))){
		$body.='<p><strong>Форма оплати:</strong> '.$_POST['payment'].'</p>';
	}

	//if(trim(!empty($_POST['email']))){
		//$body.=$_POST['email'];
	//}	
	
	/*
	//Прикрепить файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//путь загрузки файла
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузим файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото в приложении</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>