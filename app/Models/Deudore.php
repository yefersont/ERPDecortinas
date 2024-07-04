<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Deudore
 * 
 * @property int $idDeudores
 * @property int $Cedula_deudor
 * @property int $Valor_venta_deudor
 * @property int $Abono_deudor
 * @property Carbon $Fecha_abono_deudor
 * 
 * @property Cliente $cliente
 * @property Cotizacione $cotizacione
 *
 * @package App\Models
 */
class Deudore extends Model
{
	protected $table = 'deudores';
	protected $primaryKey = 'idDeudores';
	public $timestamps = false;

	protected $casts = [
		'Cedula_deudor' => 'int',
		'Valor_venta_deudor' => 'int',
		'Abono_deudor' => 'int',
		'Fecha_abono_deudor' => 'datetime'
	];

	protected $fillable = [
		'Cedula_deudor',
		'Valor_venta_deudor',
		'Abono_deudor',
		'Fecha_abono_deudor'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'Cedula_deudor');
	}

	public function cotizacione()
	{
		return $this->belongsTo(Cotizacione::class, 'Valor_venta_deudor');
	}
}
