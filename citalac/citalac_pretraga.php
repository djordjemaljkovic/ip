<?php #session_start(); ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div  class="sve">
        <?php include("citalac_meni.php"); ?>
        <h2>Izvrši pretragu nad knjigama</h2>
        <hr/>
        <table>
            <tr> 
            <td>
        <h3>Pretraga:</h3>

        <form action="citalac_pretragafajl.php" method="POST">
        <table id="tabela" class="nav sve">
            <th>
                PRONADJITE KNJIGU
            </th>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    Naziv knjige :
                </td>
                <td>
                    <input type="text" name="imeKnjige"/> <br/>
                </td>
                
                <td>
                    <input class="dugme" type="submit" name="citalacPretragaPoNazivu" value="Pretrazi po nazivu"/><br/>
                </td>
                
            </tr>
            <tr>
                <td>
                    Autor :
                </td>
                <td>
                    <input type="text" name="pisacKnjige"/> <br/>
                </td>
                <td>
                    <input class="dugme" type="submit" name="citalacPretragaPoAutoru" value="Pretrazi po autoru"/><br/>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td colspan="2">
                    
                    
                    <input class="dugme" type="reset" value="Poništi"/>
                </td>
            </tr> 
            </table>
            </form>
       </td>
        
        <td>
            <h3>Napredna pretraga:</h3>

        <form action="citalac_naprednapretragafajl.php" method="POST">
        <table id="tabela" class="nav sve">
            <th>
                PRONADJITE KNJIGU
            </th>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    Zanr knjige :
                </td>
                <td colspan="2" align="center">
                    <select name="zanr[]" id="zanr" multiple>
                        <option value="naucni">Naučni</option>
                        <option value="fiktivni">Fiktivni</option>
                        <option value="akcioni">Akcioni</option>
                        <option value="psiholoski">Psihološki</option>
                        <option value="triler">Triler</option>
                        <option value="komedija">Komedija</option>
                        <option value="romantika">Romantika</option>
                    </select> 
                </td>
                <td>
                    <input class="dugme" type="submit" name="citalacPretragaPoZanru" value="Pretrazi po zanru"/><br/>
                </td>
                
            </tr>
            <tr>
                <td>
                    Godina izdavanja(od-do) :
                </td>
                <td>
                    <input type="text" name="godinaOd"/> <br/>
                </td>
                <td>
                    <input type="text" name="godinaDo"/> <br/>
                </td>
                <td>
                    <input class="dugme" type="submit" name="citalacPretragaPoGodini" value="Pretrazi po godini"/><br/>
                </td>
            </tr>
            <tr>
                <td>
                    Izdavač :
                </td>
                <td colspan="2" align="center">
                    <input type="text" name="izdavac"/> <br/>
                </td>
                <td>
                    <input class="dugme" type="submit" name="citalacPretragaPoIzdavacu" value="Pretrazi po izdavacu"/><br/>
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td>
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td colspan="2">
                    
                    
                    
                    <input class="dugme" type="reset" value="Poništi"/>
                </td>
            </tr> 
            </table>
            </form>
        </td>
        </tr>
            
        </table>
        </div>
    </body>
</html>

