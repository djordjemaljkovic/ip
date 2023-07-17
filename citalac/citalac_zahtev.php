<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div  class="sve">
        <?php include("citalac_meni.php"); ?>
        <h2>Posalji zahtev za dodavanje knjige u biblioteku</h2>
        <hr/>
        
        
        <form action="citalac_zahtevfajl.php" method="POST" enctype="multipart/form-data">
                <?php 
                include_once('../errors.php'); ?>
                <div>
                <table  class="sve nav">
                    <th colspan="2">
                        DODAJ KNJIGU
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
                            Naziv knjige:
                        </td>
                        <td>
                            <input type="text" name="naziv" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Autor : 
                        </td>
                        <td>
                            <input type="text" name="autor" required/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Zanr : 
                        </td>
                        <td>
                            <select name="zanr[]" id="zanr" multiple>
                                <option value="naucni">Naučni</option>
                                <option value="fiktivni">Fiktivni</option>
                                <option value="akcioni">Akcioni</option>
                                <option value="psiholoski">Psihološki</option>
                                <option value="triler">Triler</option>
                                <option value="komedija">Komedija</option>
                                <option value="romantika">Romantika</option>
                            </select> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Izdavac :
                        </td>
                        <td>
                            <input type="text" name="izdavac" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Godina izdavanja :
                        </td>
                        <td>
                            <input type="text" name="godinaIzdavanja" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Jezik :
                        </td>
                        <td>
                            <input type="text" name="jezik" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Slika :
                        </td>
                        <td>
                            <input type="file" name="slikaKnjiga" /> <br/>
                        </td>
                    </tr>
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
                        <td>
                            <input class="dugme" type="submit" name="insertzahtev" value="Unesi"/>
                            <input class="dugme" type="reset" value="Poništi"/>
                        </td>
                    </tr>
                </table>
                </form>

        
        
        </div>
        
    </body>
</html>

