<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cotizacione
 * 
 * @property int $idCotizaciones
 * @property int $Cedula_cli_coti
 * @property int $Tp_producto_coti
 * @property float $Ancho_coti
 * @property float $Alto_coti
 * @property string $Mando_coti
 * @property int $Valortotal_coti
 * @property Carbon $Fecha_coti
 * 
 * @property Cliente $cliente
 * @property TipoProducto $tipo_producto
 * @property Collection|Deudore[] $deudores
 * @property Collection|Venta[] $ventas
 *
 * @package App\Models
 */
class Cotizacione extends Model
{
	protected $table = 'cotizaciones';
	protected $primaryKey = 'idCotizaciones';
	public $timestamps = false;

	protected $casts = [
		'Cedula_cli_coti' => 'int',
		'Tp_producto_coti' => 'int',
		'Ancho_coti' => 'float',
		'Alto_coti' => 'float',
		'Valortotal_coti' => 'int',
		'Fecha_coti' => 'datetime'
	];

	protected $fillable = [
		'Cedula_cli_coti',
		'Tp_producto_coti',
		'Ancho_coti',
		'Alto_coti',
		'Mando_coti',
		'Valortotal_coti',
		'Fecha_coti'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'Cedula_cli_coti');
	}

	public function tipo_producto()
	{
		return $this->belongsTo(TipoProducto::class, 'Tp_producto_coti');
	}

	public function deudores()
	{
		return $this->hasMany(Deudore::class, 'Valor_venta_deudor');
	}

	public function ventas()
	{
		return $this->hasMany(Venta::class, 'Cotizacion_venta');
	}
}
