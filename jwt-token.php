<?php

require_once __DIR__ . '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTAuth {

    private string $accessSecret = 'f02741024fda9ccc8f70eedef93692c8085a0db7';
    private string $refreshSecret = 'bc45117a7bb481bd0d9b11594968c46d5c85dd67';
    private string $algo = 'HS256';

    /**
     * Generate Access Token (short lived)
     */
    public function generateAccessToken(int $userId, string $email): string
    {
        $issuedAt   = time();
        $expire     = $issuedAt + (60 * 15); // 15 minutes

        $payload = [
            'iss' => 'your-domain.com',
            'iat' => $issuedAt,
            'exp' => $expire,
            'type'=> 'access',
            'data' => [
                'user_id' => $userId,
                'email'   => $email,
            ]
        ];

        return JWT::encode($payload, $this->accessSecret, $this->algo);
    }

    /**
     * Generate Refresh Token (long lived)
     */
    public function generateRefreshToken(int $userId, string $email): string
    {
        $issuedAt   = time();
        $expire     = $issuedAt + (60 * 60 * 24 * 30); // 30 days

        $payload = [
            'iss' => 'your-domain.com',
            'iat' => $issuedAt,
            'exp' => $expire,
            'type'=> 'refresh',
            'data' => [
                'user_id' => $userId,
                'email'   => $email,
            ]
        ];

        return JWT::encode($payload, $this->refreshSecret, $this->algo);
    }

    /**
     * Validate token
     */
    public function validateAccessToken(string $token)
    {
        return JWT::decode($token, new Key($this->accessSecret, $this->algo));
    }

    public function validateRefreshToken(string $token)
    {
        return JWT::decode($token, new Key($this->refreshSecret, $this->algo));
    }
}