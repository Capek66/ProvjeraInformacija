//JavaScript

//JQuery
$(document).ready(function(){
    console.log("Ready");
    $("#menuButton").click(function(){
        $("#hidden").slideToggle("fast");
    });
    
    $("#korisnicko_ime").keyup(function(){
        var korisnicko_ime = $("#korisnicko_ime").val();
        var url = "../skripte/provjera.php?korisnicko_ime="+korisnicko_ime;
        $.ajax({type: "get", url: url, dataType: "json", complete: function(data){
                var json = $.parseJSON(data.responseText);
                if(json["korisnicko_ime"] !== null){
                    $("#provjera").append("Korisnik sa tim korisničkim imenom već postoji!");
                    $("#registriraj").prop("disabled", true);
                }else{
                    $("#provjera").empty();
                    $("#registriraj").prop("disabled", false);
                }
            }});
    });
    
    $("#registriraj").click(function(e){
        if(testImePrezime($("#ime").val()) && testImePrezime($("#prezime").val()) && testKorIme($("#korisnicko_ime").val()) && testPassword($("#lozinka").val()) && testPassword($("#lozinka2").val()) && testEmail($("#email").val()) && ($("#lozinka").val() === $("#lozinka2").val())){
            $("#registracija").submit();
        }else{
            $("#greska").empty();
            var greska = "";
            if(!testImePrezime($("#ime").val())) greska += "Pogresan format imena!<br>";
            if(!testImePrezime($("#prezime").val())) greska += "Pogresan format prezimena!<br>";
            if(!testKorIme($("#korisnicko_ime").val())) greska += "Pogresan format korisničkog imena!<br>";
            if(!testPassword($("#lozinka").val())) greska += "Pogresan format lozinke!<br>";
            if(!testEmail($("#email").val())) greska += "Pogresan format emaila!<br>";
            if($("#lozinka").val() !== $("#lozinka2").val()) greska += "Lozinke se ne poklapaju!<br>";
            $("#greska").append(greska);
            e.preventDefault();
        }
    });
    
    $("#zabLoz").click(function(){
        var korisnicko_ime = prompt("Unesite Vaše korisničko ime za oporavak lozinke!");
        window.location.replace("./reset_pass.php?reset&korisnicko_ime="+korisnicko_ime);
    });
    
    $("#prihvacam").click(function(){
        $("#uvjeti").toggle("false");
        var expDate = new Date;
        expDate.setDate(parseInt(expDate.getDate()) + parseInt(2));
        var cookieString = "uvjeti_koristenja=prihvaceni; expires=" + expDate + ";";
        document.cookie = cookieString;
        $.ajax({type: "POST", url: "./skripte/unesiKolacic.php", data: {kolacic_id: 1}, dataType: "json"});
    });
    
    $("#ne_prihvacam").click(function(){
        $("#uvjeti").toggle("false");
        var expDate = new Date;
        expDate.setDate(parseInt(expDate.getDate()) + parseInt(2));
        var cookieString = "uvjeti_koristenja=odbijeni; expires=" + expDate + ";";
        document.cookie = cookieString;
    });
    
    $("#galerija_vijesti").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "index.php" ||skripta === ""){
            DohvatiVijest("ASC", "id");
        }
    });
    
    $("#sort").change(function(){
        if($(this).val() == "broj_pregleda;ASC" || $(this).val() == "broj_pregleda;DESC"){
            var data = $(this).val().split(";");
            DohvatiVijest(data[1], data[0]);
        }else if($(this).val() == "kategorija_id"){
            DohvatiVijest("ASC", $(this).val());
        }else{
            DohvatiVijest("ASC", "id");
        }
    });
    
    function DohvatiVijest(smjer, atribut){
        var prikaz = "";
        $("#vijest").empty();
        $.ajax({type: "POST", url: "./skripte/dohvatiVijest.php", data: {order: smjer, atribut: atribut}, dataType: "json", complete: function(data){
            var vijest = $.parseJSON(data.responseText);
            for(var i=0; i<vijest.length; i++){
                prikaz += "<div id='galerija_vijesti' onmouseenter='unesiPregled("+vijest[i]["id"]+")'>";
                prikaz += "<div id='naslov_vijesti'><h3>"+vijest[i]["naslov"]+"</h3></div>";
                if(vijest[i]["slika"] != null){
                    prikaz += "<div id='slika_vijesti'><img src='"+vijest[i]["slika"]+"' alt='Slika članka' width='auto' height='400px'></div><br>";
                }
                prikaz += "<div id='clanak_vijesti'><p>"+vijest[i]["clanak"]+"</p></div><br>";
                if(vijest[i]["medij"] != null){
                    var medij = vijest[i]["medij"];
                    var ekstenzija = medij.split('.').pop();
                    prikaz += "<div id='medij'>";
                    if(ekstenzija === "mp3"){
                        prikaz += "<audio controls><source src='"+vijest[i]["medij"]+"' type='audio/mp3'></audio><br>";
                    }
                    if(ekstenzija === "mp4"){
                        prikaz += "<video width='100%' height='auto' controls><source src='"+vijest[i]["medij"]+"' type='audio/mp4'></video><br>";
                    }
                    prikaz += "</div>";
                }
                prikaz += "<hr><div id='info_vijesti'><span>Autor: <b>"+vijest[i]["autor"]+"</b><br>";
                if(vijest[i]["izvor"] != null && vijest[i]["izvor"] != ""){
                    prikaz += "Izvor: <a href='https://"+vijest[i]["izvor"]+"'>"+vijest[i]["izvor"]+"</a><br>";
                }
                prikaz += "Datum i vrijeme objave: "+vijest[i]["datum_vrijeme"]+"<br>";
                prikaz += "Kategorija: "+vijest[i]["kategorija"]+"<br>";
                prikaz += "Broj pregleda: "+vijest[i]["broj_pregleda"]+"</span></div></div><br><br>";
                
            }
            $("#vijest").append(prikaz);
        }});   
    }
    
    $("#tagoviFilter").keyup(function(){
        var tagovi = $(this).val();
        if(tagovi == ""){
            DohvatiVijest("ASC", "id");
        }else{
            var prikaz = "";
            $("#vijest").empty();
            var tag = tagovi.split(",");
            for(var j=0;j<tag.length;j++){
                if(tag[j] != ""){
                    $.ajax({type: "POST", url: "./skripte/filtriraneVijesti.php", data: {tag: tag[j]}, dataType: "json", complete: function(data){
                        var vijest = $.parseJSON(data.responseText);
                        for(var i=0; i<vijest.length; i++){
                            if(vijest[i] != null){
                                prikaz += "<div id='galerija_vijesti' onmouseenter='unesiPregled("+vijest[i]["id"]+")'>";
                                prikaz += "<div id='naslov_vijesti'><h3>"+vijest[i]["naslov"]+"</h3></div>";
                                if(vijest[i]["slika"] != null){
                                    prikaz += "<div id='slika_vijesti'><img src='"+vijest[i]["slika"]+"' alt='Slika članka' width='auto' height='400px'></div><br>";
                                }
                                prikaz += "<div id='clanak_vijesti'><p>"+vijest[i]["clanak"]+"</p></div><br>";
                                if(vijest[i]["medij"] != null){
                                    var medij = vijest[i]["medij"];
                                    var ekstenzija = medij.split('.').pop();
                                    prikaz += "<div id='medij'>";
                                    if(ekstenzija === "mp3"){
                                        prikaz += "<audio controls><source src='"+vijest[i]["medij"]+"' type='audio/mp3'></audio><br>";
                                    }
                                    if(ekstenzija === "mp4"){
                                        prikaz += "<video width='100%' height='auto' controls><source src='"+vijest[i]["medij"]+"' type='audio/mp4'></video><br>";
                                    }
                                    prikaz += "</div>";
                                }
                                prikaz += "<hr><div id='info_vijesti'><span>Autor: <b>"+vijest[i]["autor"]+"</b><br>";
                                if(vijest[i]["izvor"] != null && vijest[i]["izvor"] != ""){
                                    prikaz += "Izvor: <a href='https://"+vijest[i]["izvor"]+"'>"+vijest[i]["izvor"]+"</a><br>";
                                }
                                prikaz += "Datum i vrijeme objave: "+vijest[i]["datum_vrijeme"]+"<br>";
                                prikaz += "Kategorija: "+vijest[i]["kategorija"]+"<br>";
                                prikaz += "Broj pregleda: "+vijest[i]["broj_pregleda"]+"</span></div></div><br><br>";
                                $("#vijest").empty();
                                $("#vijest").append(prikaz);
                            }
                        }     
                    }});
                }
            }
        }
    });
    
    $("#razdoblje_od").keyup(function(){
        if($(this).val() == ""){
            if($("#razdoblje_do").val() == ""){
                DohvatiVijest("ASC", "id");
            }else{
                if(provjeriDatum($("#razdoblje_do").val()) ||provjeriSamoDatum($("#razdoblje_do").val())){
                    rangLista(null, $("#razdoblje_do").val());
                }
            }
        }else{
            if(provjeriDatum($(this).val()) || provjeriSamoDatum($(this).val())){
                if($("#razdoblje_do").val() == ""){
                    rangLista($("#razdoblje_od").val(), null);
                }else{
                    if(provjeriDatum($("#razdoblje_do").val()) ||provjeriSamoDatum($("#razdoblje_do").val())){
                        rangLista($(this).val(), $("#razdoblje_do").val());
                    }
                }
            }
        }
    });
    
    $("#razdoblje_do").keyup(function(){
        if($(this).val() == ""){
            if($("#razdoblje_od").val() == ""){
                DohvatiVijest("ASC", "id");
            }else{
                if(provjeriDatum($("#razdoblje_od").val()) ||provjeriSamoDatum($("#razdoblje_od").val())){
                    rangLista($("#razdoblje_od").val(), null);
                }
            }
        }else{
            if(provjeriDatum($(this).val()) || provjeriSamoDatum($(this).val())){
                if($("#razdoblje_od").val() == ""){
                    rangLista(null, $("#razdoblje_do").val());
                }else{
                    if(provjeriDatum($("#razdoblje_od").val()) ||provjeriSamoDatum($("#razdoblje_od").val())){
                        rangLista($("#razdoblje_od").val(), $(this).val());
                    }
                }
            }
        }
    });
    
    function rangLista(od_datum, do_datum){
        var prikaz = "";
        $.ajax({type: "POST", url: "./skripte/radobljePoredak.php", data: {od_datum: od_datum, do_datum: do_datum}, dataType: "json", complete: function(data){
            var vijest = $.parseJSON(data.responseText);
            $("#vijest").empty();
            if(vijest[0] != null){
            for(var i=0; i<vijest.length; i++){
                if(vijest[i] != null){
                    prikaz += "<div id='galerija_vijesti' onmouseenter='unesiPregled("+vijest[i]["id"]+")'>";
                    prikaz += "<div id='naslov_vijesti'><h3>"+vijest[i]["naslov"]+"</h3></div>";
                    if(vijest[i]["slika"] != null){
                        prikaz += "<div id='slika_vijesti'><img src='"+vijest[i]["slika"]+"' alt='Slika članka' width='auto' height='400px'></div><br>";
                    }
                    prikaz += "<div id='clanak_vijesti'><p>"+vijest[i]["clanak"]+"</p></div><br>";
                    if(vijest[i]["medij"] != null){
                        var medij = vijest[i]["medij"];
                        var ekstenzija = medij.split('.').pop();
                        prikaz += "<div id='medij'>";
                        if(ekstenzija === "mp3"){
                            prikaz += "<audio controls><source src='"+vijest[i]["medij"]+"' type='audio/mp3'></audio><br>";
                        }
                        if(ekstenzija === "mp4"){
                            prikaz += "<video width='100%' height='auto' controls><source src='"+vijest[i]["medij"]+"' type='audio/mp4'></video><br>";
                        }
                        prikaz += "</div>";
                    }
                    prikaz += "<hr><div id='info_vijesti'><span>Autor: <b>"+vijest[i]["autor"]+"</b><br>";
                    if(vijest[i]["izvor"] != null && vijest[i]["izvor"] != ""){
                        prikaz += "Izvor: <a href='https://"+vijest[i]["izvor"]+"'>"+vijest[i]["izvor"]+"</a><br>";
                    }
                    prikaz += "Datum i vrijeme objave: "+vijest[i]["datum_vrijeme"]+"<br>";
                    prikaz += "Kategorija: "+vijest[i]["kategorija"]+"<br>";
                    prikaz += "Broj pregleda: "+vijest[i]["broj_pregleda"]+"</span></div></div><br><br>";
                    $("#vijest").empty();
                    $("#vijest").append(prikaz);
                }
            }   }  
        }});
    }
    
    $("#resetGumb").click(function(){
        $("#razdoblje_od").val("");
        $("#razdoblje_do").val("");
        $("#tagoviFilter").val("");
        $("#sort").val("odaberite");
        DohvatiVijest("ASC", "id");
    });
    
    var vijestID = 0;
    $("#mojeVijesti_galerija").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "mojeVijesti.php"){
            vijestID = 0;
            AutoroveVijest("ASC", ">", "id");
        }
    });
    
    $("#mojeVijesti_lijevo").click(function(){
        AutoroveVijest("DESC", "<");
    });
    
    $("#mojeVijesti_desno").click(function(){
        AutoroveVijest("ASC", ">");
    });
    
    function AutoroveVijest(smjer, strelica){
        var prikaz = "";
        var recenzija = "";
        $.ajax({type: "POST", url: "./skripte/autoroveVijesti.php", data: {id: vijestID, order: smjer, znak: strelica}, dataType: "json", complete: function(data){
                if(data.responseText === ""){
                    $("#mojevijest").empty();
                    $("#mojevijest").append("<div id='naslov_vijesti'><h3>Autor nije napisao niti jednu vijest!</h3></div>");
                }else{
                    var vijest = $.parseJSON(data.responseText);
                    vijestID = vijest["id"];
                    prikaz = "<div id='naslov_vijesti'><h3>"+vijest["naslov"]+"</h3></div>";
                    if(vijest["slika"] != null){
                        prikaz += "<div id='slika_vijesti'><img src='"+vijest["slika"]+"' alt='Slika članka' width='auto' height='400px'></div><br>";
                    }
                    prikaz += "<div id='clanak_vijesti'><p>"+vijest["clanak"]+"</p></div><br>";
                    if(vijest["medij"] != null){
                        var medij = vijest["medij"];
                        var ekstenzija = medij.split('.').pop();
                        prikaz += "<div id='medij'>";
                        if(ekstenzija === "mp3"){
                            prikaz += "<audio controls><source src='"+vijest["medij"]+"' type='audio/mp3'></audio><br>";
                        }
                        if(ekstenzija === "mp4"){
                            prikaz += "<video width='100%' height='auto' controls><source src='"+vijest["medij"]+"' type='audio/mp4'></video><br>";
                        }
                        prikaz += "</div>";
                    }
                    prikaz += "<hr><div id='info_vijesti'><span>Autor: <b>"+vijest["autor"]+"</b><br>";
                    if(vijest["izvor"] != null && vijest["izvor"] != ""){
                        prikaz += "Izvor: <a href='https://"+vijest["izvor"]+"'>"+vijest["izvor"]+"</a><br>";
                    }
                    prikaz += "Datum i vrijeme objave: "+vijest["datum_vrijeme"]+"<br>";
                    prikaz += "Kategorija: "+vijest["kategorija"]+"<br>";
                    prikaz += "Broj pregleda: "+vijest["broj_pregleda"]+"<br>";
                    prikaz += "Status vijesti: "+vijest["status"]+"</span></div>";
                    if(vijest["status"] === "dorada"){
                        prikaz += "<br><div style='text-align: right;'><button class='gumb' id='azuriraj'>Ažuriraj</button></div>";
                    }
                    if(vijest["status"] === "dorada"){
                        recenzija = "<div id='naslov_vijesti'><h3 style='color: red; text-decoration: underline;'>Recenzija</h3></div><br>";
                    }else{
                        recenzija = "<div id='naslov_vijesti'><h3>Recenzija</h3></div><br>";
                    }
                    recenzija += "<div id='clanak_vijesti'><p>"+vijest["recenzija"]+"</p></div><br>";
                    recenzija += "<div id='info_vijesti'>Činjenične pogreške: "+vijest["cinj_pogr"]+"<br>Gramatičke pogreške: "+vijest["gram_pogr"]+"<br>Nedostatak materijala: "+vijest["ned_mat"]+"<br>Nedostatak izvora: "+vijest["ned_izv"]+"</div><br>";
                    recenzija += "<div id='info_vijesti'>Recenzent: <b>"+vijest["recenzent"]+"</b></div>";
                    $("#mojevijest").empty();
                    $("#mojevijest").append(prikaz);
                    $("#recenzije").empty();
                    $("#recenzije").append(recenzija);
                }

        }});   
    }
    
    $("#dodajVijest").click(function(){
        window.location.replace("./vijest.php");
    });
    
    $("#nova_vijest").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "vijest.php"){
            $.ajax({type: "POST", url: "./skripte/dohvatiKategorije.php", dataType: "json", complete: function(data){
                var kategorije = $.parseJSON(data.responseText);
                var opcije = "";
                for(var i=0; i < kategorije.length; i++){
                    opcije += "<option value='"+kategorije[i]["id"]+"'>"+kategorije[i]["naziv"]+"</option>";
                }
                $("#kategorija").append(opcije);
            }});
        }
    });
    
    $("#dodaj").click(function(e){
        e.preventDefault();
        $("#greske").empty();
        var ispravno = provjeriPodatke();
        if(ispravno === true){
            $("#nova_vijest").submit();
        }
    });
    
    $("#mojevijest").on('click', '#azuriraj', function(){
        window.location.replace("./vijest.php?id="+vijestID);
    });
    
    $("#azurirajVijest").click(function(e){
        e.preventDefault();
        $("#greske").empty();
        var ispravno = provjeriPodatkeZaAzuriranje();
        if(ispravno === true){
            $("#nova_vijest").submit();
        }
    });
    
    $("#blokiraneKtaegorije").click(function(){
        window.location.replace("./blokiraneKategorije.php");
    });
    
    $("#tablicaBlokKategorije").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "blokiraneKategorije.php"){
            var tablica = "<table id='blokiraneKategorije'><thead><tr><th>Naziv kategorije</th><th>Razlog</th><th>Blokiran do</th></tr></thead><tbody>";
            $.ajax({type: "POST", url: "./skripte/blokiraneKategorijeKorisnika.php", dataType: "json", complete: function(data){
                var kategorije = $.parseJSON(data.responseText);
                if(kategorije[0] == null){
                    tablica = "<div style='text-align: center;'><b>Niste blokirani ni u jednoj kategoriji!</b></div>";
                    $("#tablicaBlokKategorije").append(tablica);
                }else{
                    for(var i=0; i<kategorije.length; i++){
                    tablica += "<tr><td>"+kategorije[i]["naziv"]+"</td><td>"+kategorije[i]["razlog"]+"</td><td>"+kategorije[i]["blokiran_do"]+"</td></tr>";
                    }
                    tablica += "</tbody></table>";
                    $("#tablicaBlokKategorije").append(tablica);
                    $("#blokiraneKategorije").dataTable({
                        "paging" : true,
                        "bSort" : true,
                        "bFilter" : true
                    });
                }
            }});
        }
    });
    
    $("#statistika").click(function(){
        window.location.replace("./statistika.php");
    });
    
    $("#stat").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "statistika.php"){
            var tablica = "<table id='statistikaVijesti'><thead><tr><th>Naslov vijesti</th><th>Broj pregleda</th></tr></thead><tbody>";
            $.ajax({type: "POST", url: "./skripte/pripremiStatistiku.php", data: {redoslijed: "DESC"}, dataType: "json", complete: function(data){
                var vijesti = $.parseJSON(data.responseText);
                for(var i=0; i<vijesti.length; i++){
                    tablica += "<tr><td><b>"+vijesti[i]["naslov"]+"</b></td><td>"+vijesti[i]["pregledi"]+"</td></tr>";
                }
                tablica += "</tbody></table>";
                $("#stat").append(tablica);
                $("#statistikaVijesti").dataTable({
                    "paging" : true,
                    "bSort" : true,
                    "bFilter" : true,
                    "order" : [[1,"desc"]]
                });
            }});
        }
    });
    
    $("#kategorijeModeratora").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "mojeKategorije.php"){
            var tablica = "<table id='kategorijeTablica'><thead><tr><th>Naslov vijesti</th><th>Autor</th><th>Verzija</th><th>Kategorija</th><th>Recenziraj</th></tr></thead><tbody>";
            $.ajax({type: "POST", url: "./skripte/dohvatiRecenzije.php", dataType: "json", complete: function(data){
                var vijesti = $.parseJSON(data.responseText);
                if(vijesti[0] == null){
                    tablica = "<div style='text-align: center;'><b>Nema vijesti u statusu recenzije!</b></div>";
                    $("#kategorijeModeratora").append(tablica);
                }else{
                    for(var i=0; i<vijesti.length; i++){
                    tablica += "<tr id='"+vijesti[i]["vijest_id"]+"'><td><b>"+vijesti[i]["naslov_vijesti"]+"</b></td><td>"+vijesti[i]["autor"]+"</td><td>"+vijesti[i]["verzija"]+"</td><td>"+vijesti[i]["kategorija"]+"</td><td class='gumb'>Recenziraj</td></tr>";
                    }
                    tablica += "</tbody></table>";
                    $("#kategorijeModeratora").append(tablica);
                    $("#kategorijeTablica").dataTable({
                        "paging" : true,
                        "bSort" : true,
                        "bFilter" : true,
                        "order" : [[3,"asc"]]
                    });
                }
            }});
        }
    });
    
    $("#kategorijeModeratora").on('click', '#kategorijeTablica td:nth-child(5)', function(){
        var idVijesti = $(this).parent().attr("id");
        window.location.replace("./recenziranjeVijesti.php?id="+idVijesti);
    });
    
    $("#vijestRecenziranja").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "recenziranjeVijesti.php"){
            var prikaz = "";
            var id = window.location.search.split("=").pop();
            $.ajax({type: "POST", url: "./skripte/dohvatiVijestZaRecenziju.php", data: {id: id}, dataType: "json", complete: function(data){
                var vijest = $.parseJSON(data.responseText);
                prikaz = "<div id='naslov_vijesti'><h3>"+vijest["naslov"]+"</h3></div>";
                if(vijest["slika"] != null){
                    prikaz += "<div id='slika_vijesti'><img src='"+vijest["slika"]+"' alt='Slika članka' width='auto' height='400px'></div><br>";
                }else{
                    prikaz += "Vijest ne sadrži sliku.<br>";
                }
                prikaz += "<div id='clanak_vijesti'><p>"+vijest["clanak"]+"</p></div><br>";
                if(vijest["medij"] != null){
                    var medij = vijest["medij"];
                    var ekstenzija = medij.split('.').pop();
                    prikaz += "<div id='medij'>";
                    if(ekstenzija === "mp3"){
                        prikaz += "<audio controls><source src='"+vijest["medij"]+"' type='audio/mp3'></audio><br>";
                    }
                    if(ekstenzija === "mp4"){
                        prikaz += "<video width='100%' height='auto' controls><source src='"+vijest["medij"]+"' type='audio/mp4'></video><br>";
                    }
                    prikaz += "</div>";
                }else{
                    prikaz += "Vijest ne sadrži video/audio.<br>";
                }
                prikaz += "<hr><div id='info_vijesti'><span>Autor: <b>"+vijest["autor"]+"</b><br>";
                prikaz += "Izvor: <a href='https://"+vijest["izvor"]+"'>"+vijest["izvor"]+"</a><br>";
                prikaz += "Datum i vrijeme objave: "+vijest["datum_vrijeme"]+"</span></div>";
                $("#vijestRecenziranja").empty();
                $("#vijestRecenziranja").append(prikaz);
            }});
        }
    });
    
    $("#recenziraj").click(function(e){
        e.preventDefault();
        if($("#recenzijaUnos").val() != ""){
            $("#recenzija").submit();
        }else{
            $("#greskaRecenzija").empty();
            $("#greskaRecenzija").append("Recenzija ne moze biti prazna!");
        }
    });
    
    $("#odbijeneVijesti").click(function(){
        window.location.replace("./odbijeneVijesti.php");
    });
    
    $("#odbijeno").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "odbijeneVijesti.php"){
            var tablica = "<table id='odbijeneVijestiTablica'><thead><tr><th>Naslov vijesti</th><th>Autor</th><th>Kategorija</th><th>Blokiraj autora</th></tr></thead><tbody>";
            $.ajax({type: "POST", url: "./skripte/dohvatiOdbijeneVijesti.php", dataType: "json", complete: function(data){
                var vijesti = $.parseJSON(data.responseText);
                if(vijesti[0] == null){
                    tablica = "<div style='text-align: center;'><b>Nema odbijenih vijesti!</b></div>";
                    $("#odbijeno").append(tablica);
                }else{
                    var vijesti = $.parseJSON(data.responseText);
                    for(var i=0; i<vijesti.length; i++){
                        tablica += "<tr kategorija='"+vijesti[i]["kategorija_id"]+"' autor='"+vijesti[i]["autor_id"]+"'><td><b>"+vijesti[i]["naslov_vijesti"]+"</b></td><td>"+vijesti[i]["autor"]+"</td><td>"+vijesti[i]["kategorija"]+"</td><td class='gumb'>Blokiraj</td></tr>";
                    }
                    tablica += "</tbody></table>";
                    $("#odbijeno").append(tablica);
                    $("#odbijeneVijestiTablica").dataTable({
                        "paging" : true,
                        "bSort" : true,
                        "bFilter" : true
                    });
                }
            }});
        }
    });
    
    $("#odbijeno").on('click', '#odbijeneVijestiTablica td:nth-child(4)', function(){
        var idKategorija = $(this).parent().attr("kategorija");
        var idAutor = $(this).parent().attr("autor");
        window.location.replace("./blokirajKorisnika.php?kategorija="+idKategorija+"&autor="+idAutor);
    });
    
    $("#blokirajSubmit").click(function(e){
        e.preventDefault();
        if(($("#razlogBlok").val() != "") && ($("#blokiran_do").val() != "")){
            var ispravanDatum = provjeriDatum($("#blokiran_do").val());
            if(ispravanDatum){
                $("#blokiranjeKorisnika").submit();
            }else{
                $("#greskaBlock").empty();
                $("#greskaBlock").append("Neispravan format datuma i vremena!");
            }
        }else{
            $("#greskaBlock").empty();
            $("#greskaBlock").append("Popunite sva polja!");
        }
    });
    
    $("#kategorijeModeratora").on('click', '#kategorijeTablica td:nth-child(1)', function(){
        var idVijest = $(this).parent().attr("id");
        $.ajax({type: "POST", url: "./skripte/tagovi.php?dohvati", data: {id: idVijest}, dataType: "json", complete: function(data){
            var tagovi = $.parseJSON(data.responseText);
            var unos = window.prompt("Dodajte tagove za odabranu vijest", tagovi);
            if(unos != null){
                $.ajax({type: "POST", url: "./skripte/tagovi.php?unesi", data: {id: idVijest, tagovi: unos}, dataType: "json"});
            }
        }});
    });
    
    $("#zabraneObjavljivanja").click(function(){
        window.location.replace("./zabrane.php");
    });
    
    $("#zabraneAutora").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "zabrane.php"){
            var tablica = "<table id='zabraneTablica'><thead><tr><th>Autor</th><th>Kategorija</th><th>Razlog</th><th>Blokiran do</th><th>Ažuriraj zabranu</th></tr></thead><tbody>";
            $.ajax({type: "POST", url: "./skripte/dohvatiZabrane.php", dataType: "json", complete: function(data){
                var vijesti = $.parseJSON(data.responseText);
                if(vijesti[0] == null){
                    tablica = "<div style='text-align: center;'><b>Nema korisnika sa zabranama objavljivanja!</b></div>";
                    $("#zabraneAutora").append(tablica);
                }else{
                    var vijesti = $.parseJSON(data.responseText);
                    for(var i=0; i<vijesti.length; i++){
                        tablica += "<tr kategorija='"+vijesti[i]["kategorija_id"]+"' autor='"+vijesti[i]["autor_id"]+"'><td><b>"+vijesti[i]["autor"]+"</b></td><td>"+vijesti[i]["kategorija"]+"</td><td>"+vijesti[i]["razlog"]+"</td><td>"+vijesti[i]["blokiran_do"]+"</td><td class='gumb'>Ažuriraj zabranu</td></tr>";
                    }
                    tablica += "</tbody></table>";
                    $("#zabraneAutora").append(tablica);
                    $("#zabraneTablica").dataTable({
                        "paging" : true,
                        "bSort" : true,
                        "bFilter" : true,
                        "order" : [[1,"asc"]]
                    });
                }
            }});
        }
    });
    
    $("#zabraneAutora").on('click', '#zabraneTablica td:nth-child(5)', function(){
        var idKategorija = $(this).parent().attr("kategorija");
        var idAutor = $(this).parent().attr("autor");
        window.location.replace("./blokirajKorisnika.php?zabrane&kategorija="+idKategorija+"&autor="+idAutor);
    });
    
    $("#statistikaMod").click(function(){
        window.location.replace("./statistikaMod.php");
    });
    
    $("#statitikaModeratora").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "statistikaMod.php"){
            var tablica = "<table id='statMod'><thead><tr><th>Autor</th><th>Broj prihvaćenih vijesti</th><th>Broj odbijenih vijesti</th><th>Omjer prihvaćenih i odbijenih</th></tr></thead><tbody>";
            $.ajax({type: "POST", url: "./skripte/pripremiStatMod.php", dataType: "json", complete: function(data){
                var stat = $.parseJSON(data.responseText);
                if(stat[0] == null){
                    tablica = "<div style='text-align: center;'><b>Ne postoje zapisi!</b></div>";
                    $("#statitikaModeratora").append(tablica);
                }else{
                    for(var i=0; i<stat.length; i++){
                        var omjer = 0;
                        if(stat[i]["odbijene"] == 0){
                            omjer = "Nemoguće izračunati.";
                        }else{
                            omjer = stat[i]["prihvacene"]/stat[i]["odbijene"];
                        }
                        tablica += "<tr><td><b>"+stat[i]["autor"]+"</b></td><td>"+stat[i]["prihvacene"]+"</td><td>"+stat[i]["odbijene"]+"</td><td>"+omjer+"</td></tr>";
                    }
                    tablica += "</tbody></table>";
                    $("#statitikaModeratora").append(tablica);
                    $("#statMod").dataTable({
                        "paging" : true,
                        "bSort" : true,
                        "bFilter" : true,
                        "order" : [[3,"desc"]]
                    });
                }
            }});
        }
    });
    
    $("#kategorijeVijesti").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "upravljanjeKategorijama.php"){
            var tablica = "<table id='sveKategorije'><thead><tr><th>Naziv kategorije</th><th>Opis kategorije</th><th>Moderatori</th><th>Ažuriranje</th></tr></thead><tbody>";
            $.ajax({type: "POST", url: "./skripte/dohvatiKategorije.php", dataType: "json", complete: function(data){
                var kategorije = $.parseJSON(data.responseText);
                if(kategorije[0] == null){
                    tablica = "<div style='text-align: center;'><b>Ne postoje zapisi o kategorijama!</b></div>";
                    $("#kategorijeVijesti").append(tablica);
                }else{
                    for(var i=0; i<kategorije.length; i++){
                        tablica += "<tr id="+kategorije[i]["id"]+"><td><b>"+kategorije[i]["naziv"]+"</b></td><td>"+kategorije[i]["opis"]+"</td><td class='gumb'>Moderatori</td><td class='gumb'>Ažuriraj</td></tr>";
                    }
                    tablica += "</tbody></table>";
                    $("#kategorijeVijesti").append(tablica);
                    $("#sveKategorije").dataTable({
                        "paging" : true,
                        "bSort" : true,
                        "bFilter" : true,
                        "order" : [[0,"asc"]]
                    });
                }
            }});
        }
    });
    
    $("#kategorijeVijesti").on('click', '#sveKategorije td:nth-child(3)', function(){
        var idKategorija = $(this).parent().attr("id");
        window.location.replace("./moderatoriKategorije.php?id="+idKategorija);
    });
    
    $("#kategorijeVijesti").on('click', '#sveKategorije td:nth-child(4)', function(){
        var idKategorija = $(this).parent().attr("id");
        window.location.replace("./novaKategorija.php?azuriraj&id="+idKategorija);
    });
    
    $("#statistikaMod").click(function(){
        window.location.replace("./statistikaMod.php");
    });
    
    $("#modDiv").on('click', '#moderatoriKat td:nth-child(3)', function(){
        var idKorisnika = $(this).parent().attr("moderator");
        var idKategorije = $(this).parent().attr("kategorija");
        $.ajax({type: "POST", url: "./skripte/ukloniModeratora.php", data: {moderator: idKorisnika, kategorija: idKategorije}, dataType: "json", complete: function(){
                window.location.replace("./moderatoriKategorije.php?id="+idKategorije);
        }});
    });
    
    $("#izborModeratora").blur(function(){
        $.ajax({type: "POST", url: "./skripte/provjeriPostojanje.php", data: {kor_ime: $(this).val()}, dataType: "json", complete: function(data){
                var postoji = $.parseJSON(data.responseText);
                if(postoji["postoji"] == 'da'){
                    $("#dodajMod").prop("disabled", false);
                    $("#izborModeratora").prop("style", "");
                    $("#error").empty();
                }else{
                    $("#dodajMod").prop("disabled", true);
                    $("#izborModeratora").prop("style", "border: 2px solid red");
                    $("#error").empty();
                    $("#error").append("Korisnik ne postoji!");
                }
        }});
    });
    
    $("#dodajMod").click(function(){
        var kor_ime = $("#izborModeratora").val();
        var idKategorije = $("#izborModeratora").attr("kategorija");
        $.ajax({type: "POST", url: "./skripte/dodajModeratora.php", data: {moderator: kor_ime, kategorija: idKategorije}, dataType: "json", complete: function(){
                window.location.replace("./moderatoriKategorije.php?id="+idKategorije);
        }});
    });
    
    $("#dodajKategoriju").click(function(){
        window.location.replace("./novaKategorija.php");
    });
    
    $("#dodajKategorijuGumb").click(function(e){
        e.preventDefault();
        if(($("#naziv").val() != "") && ($("#opisKat").val() != "")){
            $("#nova_kategorija").submit();
        }else{
            $("#greskeKat").empty();
            $("#greskeKat").append("Sva polja moraju biti popunjena!");
        }
    });
    
    $("#obrisiKategoriju").click(function(){
        var katID = $("#katID").val();
        $.ajax({type: "POST", url: "./skripte/kategorije.php?obrisi", data: {id: katID}, dataType: "json", complete: function(){
                window.location.replace("./upravljanjeKategorijama.php");
        }});
    });
    
    
    $("#sveRecenzije").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "upravljanjeRecenzijama.php"){
            var tablica = "<table id='sveRecenzijeTablica'><thead><tr><th>Autor</th><th>Naslov vijesti</th><th>Kategorija</th><th>Recenzent</th></tr></thead><tbody>";
            $.ajax({type: "POST", url: "./skripte/vijestiRecenzija.php", dataType: "json", complete: function(data){
                var vijesti = $.parseJSON(data.responseText);
                if(vijesti[0] == null){
                    tablica = "<div style='text-align: center;'><b>Trenutno ne postoje vijesti sa statusom recenzije!</b></div>";
                    $("#sveRecenzije").append(tablica);
                }else{
                    for(var i=0; i<vijesti.length; i++){
                        tablica += "<tr id="+vijesti[i]["vijest_id"]+"><td>"+vijesti[i]["autor"]+"</td><td>"+vijesti[i]["naslov_vijesti"]+"</td><td>"+vijesti[i]["kategorija"]+"</td><td class='gumb'>Recenzent</td></tr>";
                    }
                    tablica += "</tbody></table>";
                    $("#sveRecenzije").append(tablica);
                    $("#sveRecenzijeTablica").dataTable({
                        "paging" : true,
                        "bSort" : true,
                        "bFilter" : true,
                        "order" : [[2,"asc"]]
                    });
                }
            }});
        }
    });
    
    $("#sveRecenzije").on('click', '#sveRecenzijeTablica td:nth-child(4)', function(){
        var idVijesti = $(this).parent().attr("id");
        window.location.replace("./dodijeliRecenzenta.php?id="+idVijesti);
    });
    
    $("#recenzentForma").blur(function(){
        $.ajax({type: "POST", url: "./skripte/provjeriModeratora.php", data: {kor_ime: $(this).val(), kategorija: $(this).attr("kategorija")}, dataType: "json", complete: function(data){
                var postoji = $.parseJSON(data.responseText);
                if(postoji["postoji"] == 'da'){
                    $("#pridruziRecenzenta").prop("disabled", false);
                    $("#recenzentForma").prop("style", "");
                    $("#greskaRec").empty();
                }else{
                    $("#pridruziRecenzenta").prop("disabled", true);
                    $("#recenzentForma").prop("style", "border: 2px solid red");
                    $("#greskaRec").empty();
                    $("#greskaRec").append("Korisnik ne postoji ili nije moderator kategorije!");
                }
        }});
    });
    
    $("#odjavaZapamti").click(function(){
        var lokacija = $(location).attr("href").split("/").pop();
        if(lokacija == "registracija.php"){
            lokacija = "./"+lokacija;
        }else{
            lokacija = "../"+lokacija;
        }
        var prijavljeniKorisnik = dohvatiPrijavljenogKorisnik();
        if(prijavljeniKorisnik != null){
            var expDate = new Date;
            expDate.setDate(parseInt(expDate.getDate()) + parseInt(1));
            var cookieString = prijavljeniKorisnik + "=" + lokacija + "; expires=" + expDate + ";path=/";
            document.cookie = cookieString;
        }
        
    });
    function dohvatiPrijavljenogKorisnik(){
        var cookies = document.cookie.split('; ');
            if(cookies !== null){
                for(var i=0; i<cookies.length; i++){
                    var cookieName = cookies[i].split('=');
                    if(cookieName[0] === "uvjeti_koristenja"){
                        if(cookieName[1] === "prihvaceni"){
                            for(var j=0; j<cookies.length; j++){
                                var cookieName2 = cookies[j].split('=');
                                if(cookieName2[0] === "prijavljeni_korisnik"){
                                    return cookies[j].split('=')[1];
                                }
                            }
                        }else{
                            return null;
                        }
                    }
                }
                return null;
            }
            else{
                return null;
            }
    }
    
    $("#postaviVrijeme").click(function(){
        window.open("http://barka.foi.hr/WebDiP/pomak_vremena/vrijeme.html");
    });
    
    $("#dohvatiVrijeme").click(function(){
        $.ajax({type: "POST", url: "http://barka.foi.hr/WebDiP/pomak_vremena/pomak.php?format=json", dataType: "json", complete: function(data){
            var vrijeme = $.parseJSON(data.responseText);
            vrijeme = vrijeme["WebDiP"]["vrijeme"]["pomak"]["brojSati"];
            $.ajax({type: "POST", url: "./skripte/pospremiVrijeme.php", data: {sati: vrijeme}, dataType: "json"});
        }});
    });
    
    $("#dnevnik").ready(function(){
        var skripta = window.location.pathname;
        skripta = skripta.split("/");
        skripta = skripta[skripta.length-1];
        if(skripta === "pregledDnevnika.php"){
            KreirajTablicuDnevnik();
        }
    });
    
    $("#tipFilter").change(function(){
        KreirajTablicuDnevnik();
    });
    
    $("#korisniciFilter").change(function(){
        KreirajTablicuDnevnik();
    });
    
    $("#dnevnik_razdoblje_od").keyup(function(){
        if(provjeriDatum($("#dnevnik_razdoblje_od").val())){
            KreirajTablicuDnevnik();
        }
    });
    
    $("#dnevnik_razdoblje_do").keyup(function(){
        if(provjeriDatum($("#dnevnik_razdoblje_do").val())){
            KreirajTablicuDnevnik();
        }
    });
    
    $("#dnevnik_resetGumb").click(function(){
        $("#korisniciFilter").val("odaberite");
        $("#tipFilter").val("odaberite");
        $("#dnevnik_razdoblje_od").val("");
        $("#dnevnik_razdoblje_do").val("");
        KreirajTablicuDnevnik();
    });
    
    function KreirajTablicuDnevnik(){
        var korisnik;
        var tip;
        var zapisi_od;
        var zapisi_do;
        
        if($("#tipFilter").val() == "odaberite"){
            tip = null;
        }else{
            tip = $("#tipFilter").val();
        }
        
        if($("#korisniciFilter").val() == "odaberite"){
            korisnik = null;
        }else{
            korisnik = $("#korisniciFilter").val();
        }
        
        if($("#dnevnik_razdoblje_od").val() == ""){
            zapisi_od = null;
        }else{
            zapisi_od = $("#dnevnik_razdoblje_od").val();
        }
        
        if($("#dnevnik_razdoblje_do").val() == ""){
            zapisi_do = null;
        }else{
            zapisi_do = $("#dnevnik_razdoblje_do").val();
        }
        var tablica = "<table id='dnevnikTablica'><thead><tr><th>Datum i vrijeme</th><th>Korisnik</th><th>Tip</th><th>Opis</th></tr></thead><tbody>";
        $.ajax({type: "POST", url: "./skripte/pripremiPodatkeDnevnika.php", data: {korisnik: korisnik, tip: tip, zapisi_od: zapisi_od, zapisi_do: zapisi_do}, dataType: "json", complete: function(data){
            var zapisi = $.parseJSON(data.responseText);
            if(zapisi[0] == null){
                tablica = "<div style='text-align: center;'><b>Nema zapisa u dnevniku!</b></div>";
                $("#dnevnik").empty();
                $("#dnevnik").append(tablica);
            }else{
                for(var i=0; i<zapisi.length; i++){
                tablica += "<tr><td>"+zapisi[i]["datumVrijeme"]+"</td><td>"+zapisi[i]["korisnik"]+"</td><td>"+zapisi[i]["tip"]+"</td><td>"+zapisi[i]["opis"]+"</td></tr>";
                }
                tablica += "</tbody></table>";
                $("#dnevnik").empty();
                $("#dnevnik").append(tablica);
                $("#dnevnikTablica").dataTable({
                    "paging" : true,
                    "bSort" : true,
                    "bFilter" : true
                });
            }
        }});
    }
    
    function testImePrezime(unos){
        var reImePrezime = new RegExp(/^[A-Za-z\ ŠĐČĆŽšđčćž]{1,35}$/);
        var valid = reImePrezime.test(unos);
        if(valid){
            return true;
        }
        else{
            return false;
        }
    }
    
    function testKorIme(unos){
            var reText = new RegExp(/^[A-Za-z][A-Za-z0-9_]{1,24}$/);
            var valid = reText.test(unos);
            if(valid){
                return true;
            }
            else{
                return false;
            }
        }
        
    function testPassword(password){
        var rePass = new RegExp(/^(?=(.*[A-Z]){1,})(?=(.*[a-z]){1,})(?=(.*[0-9]){1,})(?=.*[*.!@$%^&(){}[\]:;<>,.?/~_+\-=|\\]{1,})[A-Za-z0-9*.!@$%^&(){}[\]:;<>,.?/~_+\-=|\\]{10,50}$/);
        var valid = rePass.test(password);
        if(valid){
            return true;
        }
        else{
            return false;
        }
    }
    
    function testEmail(email){
            var reEmail = new RegExp(/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/);
            var valid = reEmail.test(email);
            if(valid){
                return true;
            }
            else{
                return false;
            }
        }
        
    function provjeriDatum(datum){
        var reDatum = new RegExp(/^[0-9]{4}-[0-9]{2}-[0-9]{2}\ [0-2][0-9]:[0-6][0-9]:[0-6][0-9]$/);
            var valid = reDatum.test(datum);
            if(valid){
                return true;
            }
            else{
                return false;
            }
    }
    
    function provjeriSamoDatum(datum){
        var reDatum = new RegExp(/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/);
            var valid = reDatum.test(datum);
            if(valid){
                return true;
            }
            else{
                return false;
            }
    }
        function provjeriPodatke(){
            var ispravno = true;
            
            if($("#kategorija").val() == 0){
                $("#greske").append("Pogrešna kategorija!<br>");
                ispravno = false;
            }else{
                $.ajax({type: "POST", url: "./skripte/provjeriKorisnika.php", data:{id: $("#kategorija").val()}, dataType: "json", async:false, complete: function(data){
                    var kategorije = $.parseJSON(data.responseText);
                    if(kategorije["id"] != 0){
                        $("#greske").append("<b>Ne možete objaviti vijest u ovoj kategoriji jer ste blokirani!</b><br>");
                        ispravno = false;
                    }
                }});
            }
            
            if($("#naslov").val() == ""){
                $("#greske").append("Naslov nije unesen!<br>");
                ispravno = false;
            }else{
                if($("#naslov").val().length < 10){
                    $("#greske").append("Naslov je prekratak!<br>");
                    ispravno = false;
                }
            }
            
            if($("#autor").val() == ""){
                $("#greske").append("Autor mora biti unesen!<br>");
                ispravno = false;
            }
            
            if($("#clanak").val() == ""){
                $("#greske").append("Tekst članka mora biti unesen!<br>");
                ispravno = false;
            }else{
                if($("#clanak").val().length < 100){
                    $("#greske").append("Članak je prekratak! Treba sadržavati najmanje 100 znakova.<br>");
                    ispravno = false;
                }
            }
            
            if($("#slika").val() == ""){
                $("#greske").append("Slika mora biti unesena!<br>");
                ispravno = false;
            }else{
                var file = $("#slika").prop('files');
                if(file.length !== 0){
                    var ekstenzija = file[0].name.split('.').pop();
                    if(!((ekstenzija === "png" || ekstenzija === "jpg" || ekstenzija === "jpeg") && (file[0].size <= (1*1024*1024)))){
                        $("#greske").append("Slika nije dobrog formata ili je prevelika!<br>");
                        ispravno = false;
                    }
                }
                else{
                    $("#greske").append("Greška kod upload-a slike!<br>");
                    ispravno = false;
                }
            }
            
            if($("#medij").val() != ""){
                var file = $("#medij").prop('files');
                if(file.length !== 0){
                    var ekstenzija = file[0].name.split('.').pop();
                    if(!((ekstenzija === "mp3" || ekstenzija === "mp4") && (file[0].size <= (1*1024*1024)))){
                        $("#greske").append("Video/audio nije dobrog formata ili je prevelik!<br>");
                        ispravno = false;
                    }
                }
                else{
                    $("#greske").append("Greška kod upload-a videa/audia!<br>");
                    ispravno = false;
                }
            }
            
            return ispravno;
        }
        
        function provjeriPodatkeZaAzuriranje(){
            var ispravno = true;
            
            if($("#kategorija").val() == 0){
                $("#greske").append("Pogrešna kategorija!<br>");
                ispravno = false;
            }else{
                $.ajax({type: "POST", url: "./skripte/provjeriKorisnika.php", data:{id: $("#kategorija").val()}, dataType: "json", async:false, complete: function(data){
                    var kategorije = $.parseJSON(data.responseText);
                    if(kategorije["id"] != 0){
                        $("#greske").append("<b>Ne možete promijeniti kategoriju vijesti u odabranu jer ste u toj kategoriji blokirani!</b><br>");
                        ispravno = false;
                    }
                }});
            }
            
            if($("#naslov").val() == ""){
                $("#greske").append("Naslov nije unesen!<br>");
                ispravno = false;
            }else{
                if($("#naslov").val().length < 10){
                    $("#greske").append("Naslov je prekratak!<br>");
                    ispravno = false;
                }
            }
            
            if($("#autor").val() == ""){
                $("#greske").append("Autor mora biti unesen!<br>");
                ispravno = false;
            }
            
            if($("#clanak").val() == ""){
                $("#greske").append("Tekst članka mora biti unesen!<br>");
                ispravno = false;
            }else{
                if($("#clanak").val().length < 100){
                    $("#greske").append("Članak je prekratak! Treba sadržavati najmanje 100 znakova.<br>");
                    ispravno = false;
                }
            }
            
            return ispravno;
        }
});

function unesiPregled(id){
    $.ajax({type: "POST", url: "./skripte/unesiPregled.php", data: {id: id}});
};

