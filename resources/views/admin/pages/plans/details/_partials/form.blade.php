@include('admin.includes.alerts')


<div class="form-group">
    <label>Nome:</label>
    <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $detail->name ?? old('name') }}">
</div>


<div class="grom-group">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>

