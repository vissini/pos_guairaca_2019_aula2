<div class="form-group">
    {{ $slot }}
    <div class="invalid-feedback">
        {{ $errors->first($field) }}
    </div>
</div>