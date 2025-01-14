<?php if ($showLabel && $showField): ?>
<?php if ($options['wrapper'] !== false): ?>
<div <?= $options['wrapperAttrs'] ?> >
    <?php endif; ?>
    <?php endif; ?>

    <?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
        <?= Form::label($name, $options['label'], $options['label_attr']) ?>
    <?php endif; ?>

    <?php if ($showField):
    $options['attr']['id'] = str_random(20);
    ?>

    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <?php
        $value = '';
        if (!empty($options['value'])) {
            $value = \Carbon\Carbon::parse($options['value'])->format('Y-m-d');
        }
        echo Form::input('text', $name, $value, $options['attr']);
        ?>
    </div>

    @push('js_scripts')
    <script>
        $('#<?=$options['attr']['id'];?>').datetimepicker({
            format: 'yyyy-mm-dd',
            weekStart: 1,
            todayBtn: true,
            todayHighlight: true,
            fontAwesome: true,
            minView: 'month',
            autoclose: true
        });
    </script>
    @endpush

    @include('administration::components.fields.help_block')
    <?php endif; ?>

    @include('administration::components.fields.errors')

    <?php if ($showLabel && $showField): ?>
    <?php if ($options['wrapper'] !== false): ?>
</div>
<?php endif; ?>
<?php endif; ?>