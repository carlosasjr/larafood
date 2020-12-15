@include('admin.includes.alerts')


<div class="form-group">
    <label>Identificação:</label>
    <input type="text" name="identify" class="form-control" placeholder="Identificação" value="{{ $table->identify ?? old('identify') }}">
</div>


<div class="form-group">
    <label>Descrição:</label>
    <textarea name="description" cols="30" rows="10" class="form-control">
        {{ $table->description ?? old('description') }}
    </textarea>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-primary">Salvar</button>
</div>


