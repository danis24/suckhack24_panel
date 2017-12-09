<?php
namespace App\Services\PaypalUsers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Presenters\JsonApiPresenterable as Presenterable;
use App\Services\UUIDEntity;
use Uuid;

class PaypalUser extends Model implements Presenterable{
    use SoftDeletes, UUIDEntity;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'ip', 'country', 'email', 'password'
    ];

    protected $hidden = [

    ];

    protected $cast = [
        "id" => "uuid",
    ];

    /**
     * @{inheritDoc}
     */
    public function transform() {
        $transformed = $this->toArray();
        foreach ($this->getUuidAttributeNames() as $uuidAttributeName) {
            $value = $this->getAttribute($uuidAttributeName);
            $transformed[$uuidAttributeName] = Uuid::import($value)->string;
        }
        return $transformed;
    }

    public function entityType(){
        return "Paypal_Users";
    }
}
