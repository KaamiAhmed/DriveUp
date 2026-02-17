<?php
namespace App\Services;
use App\Framework\Repository;
use App\Repositories\IForgotPasswordRepository;
use App\Repositories\ForgotPasswordRepository;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use DateTime;

class ForgotPasswordService extends Repository implements IForgotPasswordService{
    private IForgotPasswordRepository $forgotPasswordRepository;

    public function __construct()
    {
        $this->forgotPasswordRepository = new ForgotPasswordRepository();
    }

    public function forgotPassword($email){
        $user = $this->forgotPasswordRepository->getByEmail($email);
        if(!$user){
            throw new Exception("Email not found.");
        }

        $token = bin2hex(random_bytes(32));
        $tokenExpiry = new DateTime('+1 hour');

        $this->forgotPasswordRepository->setToken($user->id, $token, $tokenExpiry);

        $resetLink = "http://localhost:90/resetpassword/" . urlencode($token);

        $this->sendEmail($email, $resetLink);
    }

    private function sendEmail($email, $resetLink){
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = getenv('SMTP_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = getenv('SMTP_USER');
            $mail->Password = getenv('SMTP_PASS');
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = getenv('SMTP_PORT');

            $mail->setFrom(getenv('SMTP_FROM'), getenv('SMTP_FROM_NAME'));
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "
                <p>You requested a password reset.</p>
                <p>
                    <a href='{$resetLink}'>Reset your password</a>
                </p>
                <p>This link expires in 1 hour.</p>
            ";

            $mail->send();

        } catch (Exception $e) {
            throw new Exception('Failed to send reset email.');
        }
    }

    public function validateToken($token){
        if(!$this->forgotPasswordRepository->isTokenValid($token)){
            $this->forgotPasswordRepository->removeToken($token);
            throw new Exception("The link is expired.");
        }

        return true;
    }

    public function resetPassword($token, $password){
        $hashedpassword = password_hash($password, PASSWORD_BCRYPT);
        $this->forgotPasswordRepository->resetPassword($token, $hashedpassword);
        $this->forgotPasswordRepository->removeToken($token);
    }
}

?>