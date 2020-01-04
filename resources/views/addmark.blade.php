<html>
<body>
    <form action="/mark" method="post">
        @csrf
        <label for="name">Марка</label>
        <input type="text" name="mark" id="name"/>
        <button>Сохранить</button>
    </form>
</body>
</html>