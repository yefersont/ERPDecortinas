<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Venta
 * 
 * @property int $idVentas
 * @property Carbon $Fecha_venta
 * @property int $Cotizacion_venta
 * 
 * @property Cotizacione $cotizacione
 *
 * @package App\Models
 */
class Venta extends Model
{
	protected $table = 'ventas';
	protected $primaryKey = 'idVentas';
	public $timestamps = false;

	protected $casts = [
		'Fecha_venta' => 'datetime',
		'Cotizacion_venta' => 'int'
	];

	protected $fillable = [
		'Fecha_venta',
		'Cotizacion_venta'
	];

	public function cotizacione()
	{
		return $this->belongsTo(Cotizacione::class, 'Cotizacion_venta');
	}
}
