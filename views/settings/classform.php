<?php if (!defined('APPLICATION')) exit();

echo $this->Form->Open();
echo $this->Form->Errors();
?>
<h1><?php echo T('Add Class'); ?></h1>
<ul>
   <li>
      <div class="Info"><?php
         echo Wrap(T('Classes are used to organize galleries.', '<strong>Classes</strong> allow you to organize your galleries.'), 'div');
      ?></div>
   </li>
   <li>
      <?php
         echo $this->Form->Label('Class Name', 'ClassLabel');
		 echo "(Lowercase single words)";
         echo $this->Form->TextBox('ClassLabel');
      ?>
   </li>
   <li id="Categories">
      <?php
         echo $this->Form->CheckBox('HasCategories', 'This gallery uses categories.');
      ?>
   </li>
   <li id="Visible">
      <?php
         echo $this->Form->CheckBox('Visible', 'This gallery is publicly visible.');
      ?>
   </li>
</ul>
<?php echo $this->Form->Close('Save'); ?>