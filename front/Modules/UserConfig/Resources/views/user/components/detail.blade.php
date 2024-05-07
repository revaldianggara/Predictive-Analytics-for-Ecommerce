<div class="form-group">
    <label for="name">Nama User <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Nama User..."
        value="{{ optional($data)['obj'] ? $data['obj']->name : old('name') }}">
</div>
<div class="form-group">
    <label for="username">Username User <span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Username User..."
        value="{{ optional($data)['obj'] ? $data['obj']->username : old('username') }}">
</div>
<div class="form-group">
    <label for="email">Email User <span class="text-danger">*</span></label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email User..."
        value="{{ optional($data)['obj'] ? $data['obj']->email : old('email') }}">
</div>
<div class="form-group">
    <label for="password">Password User <span class="text-danger">*</span></label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password User...">
    <small>Aturan Password:
        <ul>
            <li>Minimal 8 karakter</li>
            <li>Minimal terdapat 1 huruf besar</li>
            <li>Minimal terdapat 1 huruf kecil</li>
            <li>Minimal terdapat 1 angka</li>
        </ul>
    </small>
</div>
<div class="form-group">
    <label for="role">Peran User <span class="text-danger">*</span></label>
    <select class="form-control select2" id="role" name="role[]" multiple>
        @foreach ($data['roles'] as $role)
            <option value="{{ $role->name }}"
                {{ optional($data)['obj'] ? (in_array($role->id, $data['user_role']) ? 'selected' : '') : '' }}>
                {{ $role->name }}</option>
        @endforeach
    </select>
</div>
