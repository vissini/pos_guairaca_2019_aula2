        {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" class="form-control" name='name' id="name" placeholder="Nome"  value="{{ $prod->name}}">
            </div>
            <div class="form-group">
                <label for="number">Número</label>
                <input type="text" class="form-control" name='number' id="number" placeholder="Insira o Número" value="{{ $prod->number }}">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="active" name="active" value="1"
                {{ $prod->active==1?'checked':'' }}
                >
                <label class="form-check-label" for="active">Ativo?</label>
            </div>
            <div class="form-group">
                <label for="category">Categoria</label>
                <select name="category" id="category" class="form-control">
                    <option {{ $prod->category=='informatica'?'selected':'' }} value='informatica'>Informatica</option>
                    <option {{ $prod->category=='moveis'?'selected':'' }} value='moveis'>Móveis</option>
                    <option {{ $prod->category=='vestuario'?'selected':'' }} value='vestuario'>Vestuário</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea name="description" id="description" cols="30" rows="2 " class="form-control">{{ $prod->description }}</textarea>
            </div>
            
        </div>