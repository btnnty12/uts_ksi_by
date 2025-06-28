<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Crypt;

class EncryptionHelper
{
    // Prefix untuk menandai data terenkripsi
    private const ENCRYPTED_PREFIX = 'encrypted:';

    /**
     * Encrypt data using Laravel's encryption.
     */
    public static function encrypt($data)
    {
        if (empty($data)) {
            return $data;
        }

        // Jika data sudah memiliki prefix terenkripsi, return as is
        if (str_starts_with($data, self::ENCRYPTED_PREFIX)) {
            return $data;
        }

        // Enkripsi data dan tambahkan prefix
        $encrypted = Crypt::encryptString($data);
        return self::ENCRYPTED_PREFIX . $encrypted;
    }

    /**
     * Decrypt data using Laravel's encryption.
     */
    public static function decrypt($data)
    {
        if (empty($data)) {
            return $data;
        }

        // Jika data tidak memiliki prefix terenkripsi, return as is
        if (!str_starts_with($data, self::ENCRYPTED_PREFIX)) {
            return $data;
        }

        try {
            // Hapus prefix dan decrypt
            $encryptedData = substr($data, strlen(self::ENCRYPTED_PREFIX));
            return Crypt::decryptString($encryptedData);
        } catch (\Exception $e) {
            // Jika gagal decrypt, kembalikan data asli tanpa prefix
            return substr($data, strlen(self::ENCRYPTED_PREFIX));
        }
    }
}