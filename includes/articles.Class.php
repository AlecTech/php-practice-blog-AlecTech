<?php

class Articles
{
    public $artId;
    public $artTitle;
    public $artContent;

    function __construct ($artId='', $artTitle='', $artContent='')

    {
        $this->id = ((integer) $artId);
        $this->title = $artTitle;
        $this->content = $artContent;


    }

    public function output()
    {       // Remember, anything OUTSIDE of PHP tags is echo'd!
            // This means the below will be output WhEN this method is called!
        ?>
            <dl>
                <dd><?php echo $this->id; ?></dd>
                
                <dd><?php echo $this->title; ?></dd>
                
                <dd><?php echo $this->content; ?></dd>
            </dl>
        <?php
    }
}