<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="firstname" placeholder="Vorname" required>
    <input type="text" name="lastname" placeholder="Nachname" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="address" placeholder="Anschrift" required>
    <input type="text" name="postcode" placeholder="PLZ" required>
    <input type="text" name="city" placeholder="Ort" required>
    <button type="submit">Registrieren</button>
</form>
