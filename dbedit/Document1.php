<html>
  <body>
    <form action="https://closure-compiler.appspot.com/compile" method="POST">
    <p>Type JavaScript code to optimize here:</p>
    <textarea name="js_code" cols="50" rows="5">
    function hello(name) {
      // Greets the user
      alert('Hello, ' + name);
    }
    hello('New user');
    </textarea>
    <input type="hidden" name="compilation_level" value="SIMPLE_OPTIMIZATIONS">
    <input type="hidden" name="output_format" value="text">
    <input type="hidden" name="output_info" value="compiled_code">
    <br><br>
    <input type="submit" value="Optimize">
    </form>
  </body>
</html>
