<?php
namespace App\Services;

use App\Services\IStudentService;
use App\Repositories\IStudentRepository;
use App\Repositories\StudentRepository;
use App\Models\Student;
use PHPMailer\PHPMailer\PHPMailer;
use Exception;

class StudentService implements IStudentService{
    private IStudentRepository $studentRepository;

    public function __construct(){
        $this->studentRepository = new StudentRepository();
    }

    public function bookTrialLesson(Student $student){
        if(!empty($student->firstname) && !empty($student->lastname) && !empty($student->email) && !empty($student->mobile) && !empty($student->dateofbirth) && !empty($student->street_house) && !empty($student->postcode) && !empty($student->residenceplace)){
            if(!filter_var($student->email, FILTER_VALIDATE_EMAIL)){
                throw new Exception("Invalid email.");
            }

            if (!preg_match('/^(\+31|0)6\d{8}$/', $student->mobile)){
                throw new Exception("Invalid mobile number.");
            }

            if($this->studentRepository->emailExists($student)){
                throw new Exception("You are already registered with this email address.");
            }
        }

        $this->studentRepository->bookTrialLesson($student);
        $this->sendEmail($student);
    }

    public function getStudentById($id){
        return $this->studentRepository->getStudentById($id);
    }

    private function sendEmail(Student $student){
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
            $mail->addAddress($student->email);

            $mail->isHTML(true);
            $mail->Subject = 'Confirmation - Registered for Trial lesson';
            $mail->Body = "
                <p>Dear {$student->firstname}!</p>
                <p>You have been registered successfully for the trial lesson. We will contact you as soon as possible via the mobile number provided by you to discuss about the date and time you are available for the trial lesson. Keep an eye on your <b>Whatsapp</b>.</p>
                <p><b>Here is how it goes next:</b></p>
                <p>- You will be picked up from your home at the decided date and time. (Do you want to be picked up from another location, for example school? Please let us know.)</p>
                <p>- Immediately after the trial lesson, you will receive an advice about the number of lessons required for you to successfully get your driver's licence. Of course, you do not need to follow that advice but it is recommended from us.</p>
                <p>- If you decide to take a package and start taking lessons at our school, you will receive an invoice from us via email. It is also possible to pay in installments after discussing with us.</p>
                <p>- After that you will get access to the <b>portal</b> where you can see your planned lessons.</p>
                <br>
                <p>Take a look at <a href='http://localhost:90/prices'>Our Packages</a>.</p>
                <br>
                <p>Any Questions? Please contact us:</p>
                <p>Via Whatsapp: <a href='https://wa.me/31687296715'>0687296715</a></p>
                <p>Call us (Mo to Fr 09:00 - 17:00): <a href='tel:+31687296715'>0687296715</a></p>
                <p>Send us an email: <a href='mailto:d.radcliffe.hp@gmail.com'>d.radcliffe.hp@gmail.com</a></p>
                <br>
                <p>With best regards,</p>
                <p>DriveUp Driving School</p>
            ";

            $mail->send();

        } catch (Exception $e) {
            throw new Exception('Failed to send reset email.');
        }
    }

}

?>