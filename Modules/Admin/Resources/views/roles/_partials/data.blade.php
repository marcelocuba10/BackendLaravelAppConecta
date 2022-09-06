@foreach ($permissions as $permission )
    <div class="form-check checkbox-style checkbox-success mb-20">
        <input class="form-check-input" name="permission[]" type="checkbox" value="{{ $permission->id }}" @if(!empty($rolePermission)) {{ in_array($permission->name, $rolePermission)  ? 'checked' : '' }} @endif>
        <label class="form-check-label" for="checkbox-1">{{ $permission->name }} </label>
    </div>
@endforeach
