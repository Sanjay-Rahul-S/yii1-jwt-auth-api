<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ApiDataController extends Controller
{
    public function actionProtected()
    {
       try 
       {
            $headers = apache_request_headers();
            $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : null;
            if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches))
            {
                $this->json(['error' => 'Authorization header missing or invalid'], 401);
                return;
            }
            $token = $matches[1];
            $key = "7268578f483b4aa737807649dd3f008ea7c6ed63ac4830918e720c7b0495eaa9";
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $this->json([
                'ok' => true,
                'message' => 'This is protected data',
                'user' => [
                    'id' => $decoded->user_id,
                    'email' => $decoded->email
                ]
            ]);
        } catch (Exception $e) {
            $this->json(['error' => 'Invalid or expired token: ' . $e->getMessage()], 401);
        }
    }

    protected function json($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        Yii::app()->end();
    }
}

