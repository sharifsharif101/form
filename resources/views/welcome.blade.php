<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج إدخال</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .field-container {
            margin-bottom: 10px;
        }
    </style>
 

</head>
<body>
    <button class="bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
        Click Me
    </button>
    
    @if($data->isNotEmpty())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Selected Items</th>
                <th>Prices</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
           
                    <td>
                        @foreach(json_decode($item->selected_items) as $selected_item)
                            {{ $selected_item }}@if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>
                        @php
                            $prices = json_decode($item->prices, true);
                        @endphp
                        <ul>
                            @foreach($prices as $price_item => $price_value)
                                <li>{{ ucfirst($price_item) }}: {{ $price_value }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No data available.</p>
@endif
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h1>نموذج إدخال</h1>
    <form id="form" action="{{ route('form.submit') }}" method="POST">
        @csrf
        <div class="field-container">
            <label for="name">الاسم:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="field-container">
            <label for="email">الايميل:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="field-container">
            <label for="phone">الموبيل:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="field-container">
            <label for="category">اختر الفواكه أو الخضروات:</label>
            <select id="category" name="category" multiple>
                <option value="apple">تفاح</option>
                <option value="banana">موز</option>
                <option value="orange">برتقال</option>
                <option value="lemon">ليمون</option>
                <option value="grape">عنب</option>
                <option value="pear">كمثرى</option>
                <option value="pineapple">أناناس</option>
                <option value="peach">خوخ</option>
                <option value="strawberry">فراولة</option>
                <option value="watermelon">بطيخ</option>
                <option value="blueberry">توت أزرق</option>
                <option value="kiwi">كيوي</option>
                <option value="plum">برقوق</option>
                <option value="mango">مانجو</option>
                <option value="papaya">بابايا</option>
                <option value="pomegranate">رمان</option>
                <option value="apricot">مشمش</option>
                <option value="cherry">كرز</option>
                <option value="fig">تين</option>
                <option value="date">تمر</option>
                <option value="carrot">جزر</option>
                <option value="cucumber">خيار</option>
                <option value="tomato">طماطم</option>
                <option value="bell_pepper">فلفل حلو</option>
                <option value="spinach">سبانخ</option>
                <option value="broccoli">بروكلي</option>
                <option value="cauliflower">قرنبيط</option>
                <option value="onion">بصل</option>
                <option value="garlic">ثوم</option>
            </select>
        </div>

    

        <input type="hidden" id="selected-items" name="selected_items">
        <input type="hidden" id="prices" name="prices">
    
  
        <div id="dynamic-fields"></div>

        <button type="submit">إرسال</button>
    </form>

     


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
    $(document).ready(function() {
    $('#category').select2({
        placeholder: 'اختر الفواكه أو الخضروات',
        allowClear: true
    });

    $('#category').on('change', function() {
        updateFields();
    });

    $('#form').on('submit', function() {
        const selectedOptions = Array.from(document.getElementById('category').selectedOptions).map(option => option.value);
        const prices = selectedOptions.reduce((acc, item) => {
            const priceInput = document.querySelector(`input[name="price_${item}"]`);
            if (priceInput) acc[item] = priceInput.value;
            return acc;
        }, {});

        $('#selected-items').val(JSON.stringify(selectedOptions));
        $('#prices').val(JSON.stringify(prices));
    });
});

function updateFields() {
    const categorySelect = document.getElementById('category');
    const selectedOptions = Array.from(categorySelect.selectedOptions).map(option => option.value);
    const dynamicFields = document.getElementById('dynamic-fields');

    // Clear previous fields
    dynamicFields.innerHTML = '';

    // Create input fields for each selected item
    selectedOptions.forEach(item => {
        const fieldContainer = document.createElement('div');
        fieldContainer.className = 'field-container';
        
        const label = document.createElement('label');
        label.textContent = `سعر ${getItemName(item)}:`;
        
        const input = document.createElement('input');
        input.type = 'number';
        input.name = `price_${item}`;
        input.required = true;
        input.step = '0.01';
        
        fieldContainer.appendChild(label);
        fieldContainer.appendChild(input);
        
        dynamicFields.appendChild(fieldContainer);
    });
}

function getItemName(value) {
    const names = {
        apple: 'تفاح',
        banana: 'موز',
        orange: 'برتقال',
        lemon: 'ليمون',
        grape: 'عنب',
        pear: 'كمثرى',
        pineapple: 'أناناس',
        peach: 'خوخ',
        strawberry: 'فراولة',
        watermelon: 'بطيخ',
        blueberry: 'توت أزرق',
        kiwi: 'كيوي',
        plum: 'برقوق',
        mango: 'مانجو',
        papaya: 'بابايا',
        pomegranate: 'رمان',
        apricot: 'مشمش',
        cherry: 'كرز',
        fig: 'تين',
        date: 'تمر',
        carrot: 'جزر',
        cucumber: 'خيار',
        tomato: 'طماطم',
        bell_pepper: 'فلفل حلو',
        spinach: 'سبانخ',
        broccoli: 'بروكلي',
        cauliflower: 'قرنبيط',
        onion: 'بصل',
        garlic: 'ثوم'
    };
    return names[value] || '';
}



    </script>

    
</body>
</html>
