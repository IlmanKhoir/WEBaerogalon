<form method="POST" action="{{ route('edit-harga-galon.store') }}">
    @csrf
    <div class="form-group">
        <label for="nama_paket">Nama Paket:</label>
        <input type="text" class="form-control" id="nama_paket" name="nama_paket" required>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" class="form-control" id="description" name="description" required>
    </div>
    <div class="form-group">
        <label for="benefit">Benefit:</label>
        <div id="benefitInputs">
            <input type="text" class="form-control" name="benefits[]" placeholder="Enter benefit">
        </div>
        <button type="button" class="btn btn-secondary" onclick="addBenefit()">Add More</button>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>

<script>
function addBenefit() {
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'benefits[]';
    input.className = 'form-control';
    input.placeholder = 'Enter benefit';
    document.getElementById('benefitInputs').appendChild(input);
}
</script>