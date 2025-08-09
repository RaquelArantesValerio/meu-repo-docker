<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Desafio Docker com PHP</title>
    <style>
        body { font-family: sans-serif; background-color: #f4f4f9; color: #333; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { text-align: center; padding: 2em; background-color: #fff; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; }
        .success { color: #27ae60; }
        .error { color: #c0392b; }
        pre { background-color: #ecf0f1; padding: 1em; border-radius: 4px; text-align: left; white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Lê as credenciais do banco de dados a partir das variáveis de ambiente
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $dbname = getenv('DB_DATABASE');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');

        // String de Conexão (DSN) para o PostgreSQL
        $dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";

        try {
            // Tenta criar uma nova instância de PDO para se conectar
            $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            
            echo "<h1><span class='success'>Conexão com o Banco de Dados PostgreSQL foi um sucesso!</span></h1>";
            echo "<p>Aplicação PHP conectada ao banco de dados '{$dbname}' no host '{$host}'.</p>";

        } catch (PDOException $e) {
            echo "<h1><span class='error'>Erro ao conectar ao Banco de Dados</span></h1>";
            echo "<p>Não foi possível estabelecer a conexão. Verifique as configurações e se o container do banco de dados está rodando.</p>";
            echo "<pre>Detalhes do erro: " . htmlspecialchars($e->getMessage()) . "</pre>";
        }
        ?>
    </div>
</body>
</html>
