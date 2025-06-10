<?php $__env->startSection('title'); ?>
<title>プロフィール編集画面</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/edit.css')); ?>" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="contents">
    <h1>プロフィール設定</h1>
    <form action="/mypage/profile/update" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="avatar-image">
            <img class="c-avatar__image" id="preview" src="<?php echo e($profile && $profile->profile_image ? asset($profile->profile_image) : asset('images/default.png')); ?>" width="100" height="100">
        <?php $__errorArgs = ['profile_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="input_error">
                <p class="input_error_message"><?php echo e($errors->first('profile_image')); ?></p>
            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <label class="image-button-label">
                画像を選択する
                <input type="file" class="image-button" id="imageUpload" name="profile_image">
            </label>
        </div>
        <label for="name" class="label">ユーザー名</label>
        <input id="name" type="text" name="name" class="text" placeholder="<?php echo e($profile && $user->name ? $user->name : ''); ?>" value="<?php echo e(old('name', $user ? $user->name : '')); ?>">
        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="input_error">
                <p class="input_error_message"><?php echo e($errors->first('name')); ?></p>
            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <label for="post_code" class="label">郵便番号</label>
        <input id="post_code" type="text" name="post_code" class="text" placeholder="<?php echo e($profile && $profile->post_code ? $profile->post_code : ''); ?>" value="<?php echo e(old('post_code', $profile ? $profile->post_code : '')); ?>">
        <?php $__errorArgs = ['post_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="input_error">
                <p class="input_error_message"><?php echo e($errors->first('post_code')); ?></p>
            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <label for="address" class="label">住所</label>
        <input id="address" type="text" name="address" class="text" placeholder="<?php echo e($profile && $profile->address ? $profile->address : ''); ?>" value="<?php echo e(old('address', $profile ? $profile->address : '')); ?>">
        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <span class="input_error">
                <p class="input_error_message"><?php echo e($errors->first('address')); ?></p>
            </span>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        <label for="building" class="label">建物名</label>
        <input id="building" type="text" name="building" class="text" placeholder="<?php echo e($profile && $profile->building ? $profile->building : ''); ?>" value="<?php echo e(old('building', $profile ? $profile->building : '')); ?>">
        <div class="button-content">
            <button class="button-update" type="submit">更新する</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    $('#imageUpload').on('change', function (e) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr('src', e.target.result)
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/edit.blade.php ENDPATH**/ ?>