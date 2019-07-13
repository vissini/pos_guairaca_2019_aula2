        {{ csrf_field() }}
        <div class="box-body">
            @component('admin.template._form_group_component', ['field' => 'name'])
                <label for="name">Nome</label>
                <input type="text" class="form-control {{ $errors->has('name')?' is-invalid':'' }}" name='name' id="name" placeholder="Nome"  value="{{ old('name', $prod->name) }}">
            @endcomponent
            @component('admin.template._form_group_component', ['field' => 'number'])
                <label for="number">Número</label>
                <input type="text" class="form-control" name='number' id="number" placeholder="Insira o Número" value="{{ old('number', $prod->number) }}">
            @endcomponent
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" 
                id="active" name="active" value="1"
                {{ old('active',$prod->active)?'checked="checked"':'' }}
                >
                <label class="form-check-label" for="active">Ativo?</label>
            </div>
            @component('admin.template._form_group_component', ['field' => 'name'])
                <label for="category">Categoria</label>
                <select name="category" id="category" class="form-control">
                    <option {{ old('category',$prod->category)=='informatica'?'selected':'' }} value='informatica'>Informatica</option>
                    <option {{ old('category',$prod->category)=='moveis'?'selected':'' }} value='moveis'>Móveis</option>
                    <option {{ old('category',$prod->category)=='vestuario'?'selected':'' }} value='vestuario'>Vestuário</option>
                </select>
            @endcomponent
            @component('admin.template._form_group_component', ['field' => 'name'])
                <label for="description">Descrição</label>
                <textarea name="description" id="description" cols="30" rows="2 " class="form-control">{{ old('description', $prod->description) }}</textarea>
            @endcomponent
            
        </div>