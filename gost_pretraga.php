<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="style.css">
<div id="zaglavlje" class="header">
            <h1>Dobrodošli na elektronsku biblioteku</h1>
        </div>
        <hr>
        <div id="navigacija" class="header">
            <ul>
                <li>&nbsp;</li>
                <li><a href="login.php">ULOGUJ SE</a></li>
                <li>&nbsp;</li>
                <li><a href="register.php">REGISTRUJ SE</a></li>
                <li>&nbsp;</li>
                <li><a href="gost_index.php">VRATI SE NA POCETNU STRANU</a></li>
            </ul>
        </div>
        <hr>

        <form action="gost_pretragafajl.php" method="POST">
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
                    <input class="dugme" type="submit" name="gostPretragaPoNazivu" value="Pretrazi po nazivu"/>
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
                    <input class="dugme" type="submit" name="gostPretragaPoAutoru" value="Pretrazi po autoru"/>
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
                <td colspan="3">
                    <input class="dugme" type="reset" value="Poništi"/>
                </td>
            </tr> 
            </table>
            </form>
        </div>
    </body>
</html>