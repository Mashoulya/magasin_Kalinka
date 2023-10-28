<?php

namespace App\Service;

use DateTimeImmutable;

class JWTService{
    // on génère le token
    /**
     * Génération du JWT
     * @param array $header
     * @param array $payload
     * @param string $secret
     * @param int $validity
     * @return string
     */
    public function generate(array $header, array $payload, string $secret, int $validity = 3600): string
    {
        if($validity <= 0){
            return "";
        }

        $now = new DateTimeImmutable();
        $exp = $now->getTimestamp() + $validity;

        $payload['iat'] = $now->getTimestamp();
        $payload['exp'] = $exp;

        // on encode en base64
        $base64Header = base64_encode(json_encode($header));
        $base64Payload = base64_encode(json_encode($payload));

        // on "nettoie" les valeurs encodées (retrait des +, / et =)
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], $base64Header);
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], $base64Payload);

        // on génère la signature
        $secret = base64_encode($secret);

        $signature = hash_hmac('sha256', $base64Header . '.' . $base64Payload, $secret, true);

        $base64Signature = base64_encode($signature);
        $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], $base64Signature);

        // on crée le token
        $jwt = $base64Header . '.' . $base64Payload . '.' . $base64Signature;

        return $jwt;
    }

    // on vérifie que le token est valide (correctement formé)
    public function tokenIsValid(string $token): bool
    {
        return preg_match(
            '/^[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+\.[a-zA-Z0-9\-\_\=]+$/',
            $token
        ) === 1;
    }

    // on récupère le payload
    public function getPayload(string $token): array
    {
        // ondémonte le token
        $array = explode('.', $token);

        // on décode le payload
        $payload = json_decode(base64_decode($array[1]), true);

        return $payload;
    }

    // on récupère le header
    public function getHeader(string $token): array
    {
        // on démonte le token
        $array = explode('.', $token);

        // on décode le header
        $header = json_decode(base64_decode($array[0]), true);

        return $header;
    }

    // on vérifie si le token a expiré
    public function tokenIsExpired(string $token): bool
    {
        $payload = $this->getPayload($token);

        $now = new DateTimeImmutable();
        return $payload['exp'] < $now->getTimestamp();
    }

    // on vérifie la signature
    public function checkSignature(string $token, string $secret)
    {
        // on récupère le header et le payload
        $header = $this->getHeader($token);
        $payload = $this->getPayload($token);

        // on régénère un token
        $verifToken = $this->generate($header,$payload, $secret);
    }
}