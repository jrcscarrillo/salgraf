<html>
        <head>
        <title>Aurora Mensajes</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="../css/demo.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/sky-forms.css">
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/sky-forms-ie8.css">
        <![endif]-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="../js/jquery.form.min.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.js"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/additional-methods.js"></script>
        <script src="../js/jquery.modal.js"></script>
        <style>
            .row {
                color: orange;
                text-align: center;
                font-family: "Times New Roman";
                font-size: 20px;
            }
        </style>
        <!--[if lt IE 10]>
        <script src="../js/jquery.placeholder.min.js"></script>
        <![endif]-->		
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <script src="../js/sky-forms-ie8.js"></script>
        <![endif]-->
    </head>
    <body class="bg-cyan">
        <div class="body body-m">		
            <form action="../index.html" id="sky-form" class="sky-form">
                <header>Continuar</header>
                <fieldset>
                    <section>  
<?php
//   parserMensajes('pruebaError.xml');
//exit();
function parserMensajes() {

//function parserMensajes($param) {
//    $doc = new DOMDocument();
//    $doc->load($param);
//    emiteMensajes($doc);
    ?>
                                            </section>
                </fieldset>
                <footer>
                    <button type="submit" class="button">Continuar</button>
                </footer>
            </form>			
        </div>
    </body>
</html>
<?php

}

function emiteMensajes( $node )
{
    $arrayError = array();
  switch ( $node->nodeType )
  {
    case XML_ELEMENT_NODE:
        
      if ( $node->hasAttributes() ) {
          foreach ( $node->attributes as $attribute ) {
//          echo "$attribute->name=\"$attribute->value\" ";
        }
      }

      echo "<br>";
      break;

    case XML_TEXT_NODE:
      if ( trim($node->wholeText) ) {
          $arrayError['Descripcion'] = strtoupper($node->parentNode->tagName);
          $arrayError['Causa'] = $node->wholeText;
              ?>
    <div class="row">DESCRIPCION: <?php echo $arrayError['Descripcion']?></div>
    <div class="row">CAUSA: <?php echo $arrayError['Causa']?></div>
<?php    
//          var_dump($arrayError);
}
  break;

case XML_CDATA_SECTION_NODE:
  if ( trim($node->data) ) {
//    echo "Found character data node: \"" .
//    htmlspecialchars($node->data) . "\"\n";
  }
  break;

}
if ( $node->hasChildNodes() ) {
  foreach ( $node->childNodes as $child ) {
      emiteMensajes( $child );
  }
 }
}
?>
