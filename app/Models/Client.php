<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Crypt;

class Client extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'domain',
        'api_key',
        'subscription_expiry_date',
    ];

    /**
     * Set the encrypted API key.
     *
     * @param  string  $value
     * @return void
     */
    public function setApiKeyAttribute($value)
    {
        // Encrypt the value before saving it
        $this->attributes['api_key'] = Crypt::encryptString($value);
    }

    /**
     * Get the decrypted API key.
     */
    public function getApiKeyAttribute($value)
    {
        // Decrypt the stored encrypted value
        return Crypt::decryptString($value);
    }
}
