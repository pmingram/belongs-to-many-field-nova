<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 2/6/19
 * Time: 5:10 PM
 */

namespace Benjacho\BelongsToManyField;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasBelongsToMany
{

    public function model($relationModel): BelongsToMany
    {
        $model = app($relationModel);
        return $this->belongsToMany($model);
    }
	
	public function syncManyValues($values, $attribute, $relationModel, $class = null, $classColumn = null)
	{
		$arrayIds = array_column($values, 'id');
		$items = [];

		if ($class !== null) {
            foreach ($arrayIds as $item) {
                $items[$item] = [$classColumn => $class];
            }

            $this->$attribute()->sync($items);
        } else {
            $this->$attribute()->sync($arrayIds);
        }
	}
}
