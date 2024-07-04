<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente
 * 
 * @property int $idClientes
 * @property int $Cedula_cli
 * @property string $Nombre_cli
 * @property string $Apellidos_cli
 * @property string $Telefono_cli
 * @property string $Direccion_cli
 * 
 * @property Collection|Cotizacione[] $cotizaciones
 * @property Collection|Deudore[] $deudores
 *
 * @package App\Models
 */
class Cliente extends Model
{
	protected $table = 'clientes';
	protected $primaryKey = 'idClientes';
	public $timestamps = false;

	protected $casts = [
		'Cedula_cli' => 'int'
	];

	protected $fillable = [
		'Cedula_cli',
		'Nombre_cli',
		'Apellidos_cli',
		'Telefono_cli',
		'Direccion_cli'
	];

	public function cotizaciones()
	{
		return $this->hasMany(Cotizacione::class, 'Cedula_cli_coti');
	}

	public function deudores()
	{
		return $this->hasMany(Deudore::class, 'Cedula_deudor');
	}
}
