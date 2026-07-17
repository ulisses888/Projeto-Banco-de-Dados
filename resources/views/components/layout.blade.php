<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title style="color: white;">Banco De Dados</title>


<!--=======================/////////////////////|||||||||||||||||||||  Estilo  |||||||||||||||||||||\\\\\\\\\\\\\\\\\\\\\\=======================-->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1A1818;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            padding: 20px;
            text-align: center;
            color: white;
            flex-shrink: 0;
        }

        h1 {
            color: white;
            text-align: center;
            font-family: 'American Typewriter', serif;
            font-size: 300%;
            margin: 0;
        }

        .main-container {
            display: flex;
            flex: 1;
            height: calc(100vh - 120px);
            padding: 20px;
        }

        /* Navegação (array de botões) */
        .nav-container {
            background-color: #2c2a2a;
            width: 200px;
            min-width: 200px;
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .nav-container p {
            color: white;
            text-align: center;
            background-color: transparent;
            width: auto;
            height: auto;
            border-radius: 0;
            margin: 0 0 20px 0;
            padding: 0;
            font-size: 14px;
        }

        .nav-container button {
            background-color: #4a4a4a;
            width: 150px;
            height: 40px;
            border-radius: 5px;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .nav-container button:hover {
            background-color: #6a6a6a;
        }

        /* fim de Navegação (array de botões) */


        /* área de conteúdo */
        .content-container {
            flex: 1;
            border-radius: 10px;
            padding: 0px 20px;
            display: flex;
            flex-direction: column;
        }

        .content-container p {
            color: white;
            text-align: left;
            background-color: transparent;
            width: auto;
            height: auto;
            border-radius: 0;
            margin: 0 0 15px 0;
            padding: 0;
            font-size: 16px;
        }

        .component-wrapper {
            flex: 1;
            background-color: #1a3d4f;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
            padding: 20px;
        }
        /* fim da área de conteúdo */


        /* configuração responsiva */
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
                height: auto;
            }

            .nav-container {
                width: 100%;
                min-width: unset;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .nav-container p {
                width: 100%;
                text-align: center;
            }

            .content-container {
                min-height: 500px;
            }
        }

           /* fim de configuração responsiva */
    </style>
</head>
<body>

<!--=======================/////////////////////|||||||||||||||||||||  Texto/funções  |||||||||||||||||||||\\\\\\\\\\\\\\\\\\\\\\=======================-->

    <!-- Header -->
    <header>
        <h1>Banco De Dados</h1>
    </header>

    <!-- Layout principal -->
    <div class="main-container">
        
        <!-- Array de Botões -->
        <div class="nav-container">
            <p>Menu</p>
            <button onclick="loadPage('projetos')" class="active">Projetos</button>
            <br>
            <button onclick="loadPage('programas')">Programas</button>
            <br>
            <button onclick="loadPage('acoes')">Ações</button>
            <br>
            <button onclick="loadPage('articulacoes')">Articulações</button>
            <br>
            <button onclick="loadPage('alunos')">Alunos</button>
            <br>
            <button onclick="loadPage('servidores')">Servidores</button>
            <br>
            <button onclick="loadPage('outros')">Outros</button>
        </div>


        <!-- Conteúdo -->
        <div class="content-container">
            <p>Área de Conteúdo</p>
            <div class="component-wrapper">
                <iframe id="contentFrame" src="{{ url('/projetos') }}"></iframe>
            </div>
        </div>
    </div>

    </div>

    <script>
        function loadPage(page) {
            const frame = document.getElementById('contentFrame');
            frame.src = `/${page}`;
            
            // Atualizar botão
            document.querySelectorAll('.nav-container button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }
    </script>

</body>
</html>