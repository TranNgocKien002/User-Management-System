
@extends('layouts.admin')

@section('title', 'Thêm Sản Phẩm Mới')

@section('content')
@if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-fluid mt-4">
  <form method="POST" action="{{ route('users.store') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
    <!-- Role ID -->
    <div class="mt-4">
        <x-input-label for="role_id" :value="__('Role ID')" />
        <x-text-input id="role_id" class="block mt-1 w-full" type="number" name="role_id" :value="old('role_id')" required />
        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
    </div>

    <!-- Status -->
    <div class="mt-4">
        <x-input-label for="status" :value="__('Status')" />
        <select id="status" name="status" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>
    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
    <button type="submit"
        class="px-6 py-2 bg-blue-600  font-semibold rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
        Create User
    </button>
</div>

</form>


</div>


@endsection

@section('JS')
<script src="https://cdn.tiny.cloud/1/nlqml8ithb5bt0vy7jx4n9e1ycdpr85hwsn9kj6siz3uf10j/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    tinymce.init({
        selector: 'textarea#product-description',
        plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount',
        toolbar: 'undo redo | blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
    });

    const generateBtn = document.getElementById('generate-variants-btn');
    const variantListContainer = document.getElementById('variant-combinations-list');
    const modalElement = document.getElementById('attributesModal');
    const attributesModal = bootstrap.Modal.getOrCreateInstance(modalElement);

    generateBtn.addEventListener('click', function() {
        const selectedValues = {};
        const selectedValueObjects = {};

        document.querySelectorAll('.attribute-value-checkbox:checked').forEach(checkbox => {
            const attributeId = checkbox.dataset.attributeId;
            const valueId = checkbox.value;
            const valueName = checkbox.nextElementSibling.textContent.trim();

            if (!selectedValues[attributeId]) {
                selectedValues[attributeId] = [];
                selectedValueObjects[attributeId] = [];
            }
            selectedValues[attributeId].push(valueId);
            selectedValueObjects[attributeId].push({ id: valueId, name: valueName });
        });

        const combinations = generateCombinations(Object.values(selectedValueObjects));

        variantListContainer.innerHTML = '';
        if (combinations.length === 0) {
            variantListContainer.innerHTML = '<p class="text-muted">Vui lòng chọn thuộc tính để tạo phiên bản.</p>';
            return;
        }

        const table = document.createElement('table');
        table.className = 'table table-bordered';
        table.innerHTML = `
            <thead class="table-light">
                <tr>
                    <th style="width: 30%;">Tên phiên bản</th>
                    <th style="width: 25%;">Giá *</th>
                    <th style="width: 20%;">Tồn kho *</th>
                    <th style="width: 25%;">Ảnh đại diện</th>
                </tr>
            </thead>
        `;
        const tbody = document.createElement('tbody');
        combinations.forEach((combo, index) => {
            const variantName = combo.map(v => v.name).join(' / ');
            const attributeValueIds = combo.map(v => v.id);

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <strong>${variantName}</strong>
                    ${attributeValueIds.map(id => `<input type="hidden" name="variants[${index}][attribute_value_ids][]" value="${id}">`).join('')}
                    <input type="hidden" name="variants[${index}][name]" value="${variantName}">
                </td>
                <td><input type="number" name="variants[${index}][price]" class="form-control form-control-sm" placeholder="Giá" required></td>
                <td><input type="number" name="variants[${index}][stock]" class="form-control form-control-sm" placeholder="SL" required></td>
                <td><input type="file" name="variants[${index}][image]" class="form-control form-control-sm"></td>
            `;
            tbody.appendChild(row);
        });
        table.appendChild(tbody);
        variantListContainer.appendChild(table);

        attributesModal.hide();
    });

    function generateCombinations(arrays, index = 0, current = []) {
        if (index === arrays.length) {
            return [current];
        }
        let result = [];
        arrays[index].forEach(item => {
            result = result.concat(generateCombinations(arrays, index + 1, [...current, item]));
        });
        return result;
    }
});
</script>
@endsection
