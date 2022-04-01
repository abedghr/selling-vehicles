<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<div class="row">
    <div class="site-login col-12">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Please fill out the following fields to login:</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<hr>
<div class="row">
    <h2>Form IO Testing</h2>
    <div id="formio" class="col-12"></div>
</div>
<link rel="stylesheet" href="https://cdn.form.io/formiojs/formio.full.min.css">
<script src="https://cdn.form.io/formiojs/formio.full.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    window.onload = function() {
        var data_attr = [];
        Formio.createForm(document.getElementById('formio'), 'https://gulzntnhfnxejyz.form.io/register',{
        }).then(function(form) {
            form.components.forEach((component) => {
                let component_attr = component.info.attr;
                if(component_attr.name != 'data[submit]') {
                    data_attr.push(component.info.attr);
                }
            })
            console.log(data_attr)
            // Triggered when they click the submit button.
            form.on('submit', function(submission) {
                var submit_data = submission.data;
                console.log(submit_data)

                // data_result = [];
                // data_attr.forEach((attr) => {
                //     let y = attr.name
                //             .replace(/\s(.)/g, function($1) { return $1.toUpperCase(); })
                //             .replace(/\s/g, '')
                //             .replace(/^(.)/, function($1) { return $1.toLowerCase(); });
                //     // data_result[] =
                // })
                if(submit_data.submit) {
                    $.ajax({
                        url: '/admin/ajax/submit-dynamic-form/',
                        method: 'POST',
                        data : {
                            'data': submit_data,
                            'url': 'https://gulzntnhfnxejyz.form.io/register'
                        },
                        success: function(result){
                            if(result.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: result.msg,
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: result.msg
                                })
                            }

                        }
                    });
                }
            });
        });
    };

</script>