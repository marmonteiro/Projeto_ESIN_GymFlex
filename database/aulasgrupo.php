<?php 
function FetchAGOrderByDay (){
    global $dbh;
    $stmt = $dbh->prepare('
        SELECT * FROM Tipo_ag 
        ORDER BY 
            CASE dia_semana 
                WHEN "Segunda-Feira" THEN 1
                WHEN "Terça-Feira" THEN 2
                WHEN "Quarta-Feira" THEN 3
                WHEN "Quinta-Feira" THEN 4
                WHEN "Sexta-Feira" THEN 5
                WHEN "Sábado" THEN 6
                ELSE 7
            END
    ');
    $stmt->execute();
    $aulas = $stmt->fetchAll();
    return $aulas;
    };
    ?>