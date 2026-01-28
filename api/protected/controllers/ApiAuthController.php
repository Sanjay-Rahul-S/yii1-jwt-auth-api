<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiAuthController extends Controller
{
    public function actionLogin()
    {
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if (!$email || !$password)
        {
            $this->json(['error' => 'Email and password required'], 400);
            return;
        }
        $user = User::model()->find('email=:email', [':email' => $email]);
        if (!$user || !password_verify($password, $user->password_hash))
        {
            $this->json(['error' => 'Invalid credentials'], 401);
        }
        $key = "7268578f483b4aa737807649dd3f008ea7c6ed63ac4830918e720c7b0495eaa9";
        $payload = [
            'user_id' => $user->id,
            'email'   => $user->email,
            'iat'     => time(),
            'exp'     => time() + 3600 // 1 hour expiration
        ];
        $jwt = JWT::encode($payload, $key, 'HS256');
        $this->json([
            'ok'      => true,
            'user_id' => $user->id,
            'email'   => $user->email,
            'token'   => $jwt
        ]);
    }

    protected function json($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        Yii::app()->end();
    }
}

