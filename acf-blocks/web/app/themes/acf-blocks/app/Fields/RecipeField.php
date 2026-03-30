<?php
namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class RecipeField extends Field{
    public function fields(){
        $fields = Builder::make(RECIPE_POST_TYPE . "-fields");
        $fields->setLocation("post_type", "==", RECIPE_POST_TYPE);
        $fields->addText("prep_time");
        $fields->addText("episode_length");
        return $fields;
    }
}
