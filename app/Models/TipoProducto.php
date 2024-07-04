<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoProducto
 * 
 * @property int $idTipo_producto
 * @property string $Nombre_tp
 * 
 * @property Collection|Cotizacione[] $cotizaciones
 *
 * @package App\Models
 */
class TipoProducto extends Model
{
	protected $table = 'tipo_producto';
	protected $primaryKey = 'idTipo_producto';
	public $timestamps = false;

	protected $fillable = [
		'Nombre_tp'
	];

	public function cotizaciones()
	{
		return $this->hasMany(Cotizacione::class, 'Tp_producto_coti');
	}
}
