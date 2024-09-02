<?php
session_start();
require_once('header.php'); 
require_once('sidebar.php'); 

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// required files for PHPMailer
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Handle form submission
if (isset($_POST["updatebtn"])) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'deyvisonogueira@gmail.com';  // Use your own email
        $mail->Password   = 'taokyoljbxbzwelo';            // Use your SMTP password
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Verifica se as variáveis de sessão 'email' e 'nome_usu' estão definidas
        if (!isset($_SESSION["email"]) || !isset($_SESSION["nome_usu"])) {
            throw new Exception("As variáveis de sessão necessárias não estão definidas.");
        }

        // Recipients
        $mail->setFrom($_SESSION["email"], $_SESSION["nome_usu"]); // Usa os dados da sessão
        $mail->addAddress($_SESSION["email"]); 
        $mail->addReplyTo($_SESSION["email"], $_SESSION["nome_usu"]); // Usa os dados da sessão

        // Content
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body    = $_POST["message"];

        // Handle file upload
        if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['attachment']['tmp_name'];
            $fileName = $_FILES['attachment']['name'];
            $fileSize = $_FILES['attachment']['size'];
            $fileType = $_FILES['attachment']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            // Validate file type
            $allowedExts = ['pdf', 'jpg', 'jpeg', 'png'];
            if (in_array($fileExtension, $allowedExts)) {
                $mail->addAttachment($fileTmpPath, $fileName); // Add attachment
            } else {
                throw new Exception("Tipo de arquivo não permitido.");
            }
        }

        // Send email
        $mail->send();
        echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href = 'home.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Erro ao enviar a mensagem: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!-- Main Content -->
<div id="content">
    <?php require_once('navbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-info" id="title">CONTATO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="user" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label> Nome Completo </label>
                        <input type="text" class="form-control form-control-user" id="name" name="name" 
                               value="<?php echo isset($_SESSION['nome_usu']) ? htmlspecialchars($_SESSION['nome_usu']) : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label> Email </label>
                        <input type="email" class="form-control form-control-user" id="email" name="email" 
                               value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label> Assunto </label>
                        <input type="text" class="form-control form-control-user" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label> Mensagem </label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label> Anexar Arquivo </label>
                        <input type="file" class="form-control" id="attachment" name="attachment">
                    </div>

                    <div class="card-footer text-muted" id="btn-form">
                        <div class="text-right">
                            <a title="Voltar" href="home.php"><button type="button" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i>&nbsp;Voltar</button></a>
                            <button type="submit" name="updatebtn" class="btn btn-info updatebtn"><i class="fa fa-envelope">&nbsp;</i>Enviar</button>
                        </div>
                    </div>
                </form>  
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<?php
require_once('footer.php');
?>
