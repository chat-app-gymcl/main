<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Prosím zadej jméno";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Prosím zadej heslo";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: ../");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Špatné prihlašovací jméno nebo heslo.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Špatné prihlašovací jméno nebo heslo.";
                }
            } else{
                echo "Oops! Nastala chyba. Prosím zkusto později.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
<script data-ad-client="ca-pub-4038561735895877" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
    <div class="wrapper">
        <h2>Přihlášení</h2>
        <p>Prosím vyplň tvé údaje pro přihlášení.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Jméno</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Heslo</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Přihlásit">
            </div>
            <p>Nemáš účet? <a href="register.php">Zde se zaregistuj</a>.</p>
        </form>
    </div>
<script type="text/javascript"  charset="utf-8">
// Place this code snippet near the footer of your page before the close of the /body tag
// LEGAL NOTICE: The content of this website and all associated program code are protected under the Digital Millennium Copyright Act. Intentionally circumventing this code may constitute a violation of the DMCA.
                            
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}(';k N=\'\',2b=\'1X\';1S(k i=0;i<12;i++)N+=2b.T(B.J(B.I()*2b.F));k 2H=6,2h=4k,2v=64,2g=37,2E=D(t){k i=!1,o=D(){z(q.1i){q.2Y(\'2L\',e);E.2Y(\'29\',e)}O{q.2X(\'2W\',e);E.2X(\'21\',e)}},e=D(){z(!i&&(q.1i||4j.2K===\'29\'||q.2P===\'2O\')){i=!0;o();t()}};z(q.2P===\'2O\'){t()}O z(q.1i){q.1i(\'2L\',e);E.1i(\'29\',e)}O{q.2M(\'2W\',e);E.2M(\'21\',e);k n=!1;2R{n=E.4h==4g&&q.27}2T(a){};z(n&&n.2S){(D r(){z(i)G;2R{n.2S(\'14\')}2T(e){G 4f(r,50)};i=!0;o();t()})()}}};E[\'\'+N+\'\']=(D(){k t={t$:\'1X+/=\',4e:D(e){k r=\'\',d,n,i,c,s,l,o,a=0;e=t.e$(e);1f(a<e.F){d=e.16(a++);n=e.16(a++);i=e.16(a++);c=d>>2;s=(d&3)<<4|n>>4;l=(n&15)<<2|i>>6;o=i&63;z(2Z(n)){l=o=64}O z(2Z(i)){o=64};r=r+U.t$.T(c)+U.t$.T(s)+U.t$.T(l)+U.t$.T(o)};G r},13:D(e){k n=\'\',d,l,c,s,a,o,r,i=0;e=e.1p(/[^A-4d-4c-9\\+\\/\\=]/g,\'\');1f(i<e.F){s=U.t$.1L(e.T(i++));a=U.t$.1L(e.T(i++));o=U.t$.1L(e.T(i++));r=U.t$.1L(e.T(i++));d=s<<2|a>>4;l=(a&15)<<4|o>>2;c=(o&3)<<6|r;n=n+R.S(d);z(o!=64){n=n+R.S(l)};z(r!=64){n=n+R.S(c)}};n=t.n$(n);G n},e$:D(t){t=t.1p(/;/g,\';\');k n=\'\';1S(k i=0;i<t.F;i++){k e=t.16(i);z(e<1C){n+=R.S(e)}O z(e>4b&&e<4a){n+=R.S(e>>6|49);n+=R.S(e&63|1C)}O{n+=R.S(e>>12|2i);n+=R.S(e>>6&63|1C);n+=R.S(e&63|1C)}};G n},n$:D(t){k i=\'\',e=0,n=48=1A=0;1f(e<t.F){n=t.16(e);z(n<1C){i+=R.S(n);e++}O z(n>47&&n<2i){1A=t.16(e+1);i+=R.S((n&31)<<6|1A&63);e+=2}O{1A=t.16(e+1);2k=t.16(e+2);i+=R.S((n&15)<<12|(1A&63)<<6|2k&63);e+=3}};G i}};k r=[\'45==\',\'3R\',\'44=\',\'43\',\'42\',\'41=\',\'40=\',\'3Z=\',\'3Y\',\'3X\',\'3W=\',\'3V=\',\'3U\',\'3T\',\'3S=\',\'4l\',\'46=\',\'4m=\',\'4E=\',\'4S=\',\'4R=\',\'4Q=\',\'4P==\',\'4O==\',\'4N==\',\'4M==\',\'4L=\',\'4K\',\'4J\',\'4I\',\'4H\',\'4G\',\'4F\',\'4D==\',\'3P=\',\'4C=\',\'4B=\',\'4A==\',\'4z=\',\'4y\',\'4x=\',\'4w=\',\'4v==\',\'4u=\',\'4t==\',\'4s==\',\'4r=\',\'4q=\',\'4p\',\'4n==\',\'3Q==\',\'3O\',\'3g==\',\'3j=\'],p=B.J(B.I()*r.F),w=t.13(r[p]),Y=w,L=1,g=\'#3l\',a=\'#3n\',W=\'#3i\',v=\'#3c\',Z=\'\',b=\'V&1O;3m!\',y=\'3k&1O;m že 3hž&1O;v&1Z;&3f; 2C-2A!\',f=\'3e 3d&1Z;3a 3b 3q 3D!\',s=\'3N&1O;n&1Z;m 2C-2A!\',i=0,u=1,n=\'3M.3L\',l=0,Q=e()+\'.38\';D h(t){z(t)t=t.1Q(t.F-15);k i=q.2r(\'3K\');1S(k n=i.F;n--;){k e=R(i[n].1T);z(e)e=e.1Q(e.F-15);z(e===t)G!0};G!1};D m(t){z(t)t=t.1Q(t.F-15);k e=q.3J;x=0;1f(x<e.F){1j=e[x].1I;z(1j)1j=1j.1Q(1j.F-15);z(1j===t)G!0;x++};G!1};D e(t){k n=\'\',i=\'1X\';t=t||30;1S(k e=0;e<t;e++)n+=i.T(B.J(B.I()*i.F));G n};D o(i){k o=[\'3p\',\'3H==\',\'3G\',\'3F\',\'2J\',\'3E==\',\'3C=\',\'3r==\',\'3B=\',\'3A==\',\'3z==\',\'3y==\',\'3x\',\'3w\',\'3v\',\'2J\'],a=[\'32=\',\'3u==\',\'3t==\',\'3s==\',\'4T=\',\'4o\',\'4V=\',\'5b=\',\'32=\',\'6d\',\'6e==\',\'6j\',\'6m==\',\'66==\',\'61==\',\'5O=\'];x=0;1J=[];1f(x<i){c=o[B.J(B.I()*o.F)];d=a[B.J(B.I()*a.F)];c=t.13(c);d=t.13(d);k r=B.J(B.I()*2)+1;z(r==1){n=\'//\'+c+\'/\'+d}O{n=\'//\'+c+\'/\'+e(B.J(B.I()*20)+4)+\'.38\'};1J[x]=1U 1V();1J[x].1W=D(){k t=1;1f(t<7){t++}};1J[x].1T=n;x++}};D C(t){};G{34:D(t,a){z(5Y q.K==\'68\'){G};k i=\'0.1\',a=Y,e=q.1d(\'1v\');e.1n=a;e.j.1l=\'1R\';e.j.14=\'-1o\';e.j.X=\'-1o\';e.j.1x=\'2e\';e.j.11=\'6l\';k d=q.K.2m,r=B.J(d.F/2);z(r>15){k n=q.1d(\'2c\');n.j.1l=\'1R\';n.j.1x=\'1y\';n.j.11=\'1y\';n.j.X=\'-1o\';n.j.14=\'-1o\';q.K.5V(n,q.K.2m[r]);n.1b(e);k o=q.1d(\'1v\');o.1n=\'2n\';o.j.1l=\'1R\';o.j.14=\'-1o\';o.j.X=\'-1o\';q.K.1b(o)}O{e.1n=\'2n\';q.K.1b(e)};l=6b(D(){z(e){t((e.28==0),i);t((e.26==0),i);t((e.1M==\'2F\'),i);t((e.1P==\'2j\'),i);t((e.1E==0),i)}O{t(!0,i)}},2a)},1K:D(e,c){z((e)&&(i==0)){i=1;E[\'\'+N+\'\'].1u();E[\'\'+N+\'\'].1K=D(){G}}O{k f=t.13(\'6c\'),u=q.6k(f);z((u)&&(i==0)){z((2h%3)==0){k l=\'5Z=\';l=t.13(l);z(h(l)){z(u.1H.1p(/\\s/g,\'\').F==0){i=1;E[\'\'+N+\'\'].1u()}}}};k p=!1;z(i==0){z((2v%3)==0){z(!E[\'\'+N+\'\'].2z){k d=[\'5S==\',\'5R==\',\'5Q=\',\'6n=\',\'5P=\'],m=d.F,a=d[B.J(B.I()*m)],r=a;1f(a==r){r=d[B.J(B.I()*m)]};a=t.13(a);r=t.13(r);o(B.J(B.I()*2)+1);k n=1U 1V(),s=1U 1V();n.1W=D(){o(B.J(B.I()*2)+1);s.1T=r;o(B.J(B.I()*2)+1)};s.1W=D(){i=1;o(B.J(B.I()*3)+1);E[\'\'+N+\'\'].1u()};n.1T=a;z((2g%3)==0){n.21=D(){z((n.11<8)&&(n.11>0)){E[\'\'+N+\'\'].1u()}}};o(B.J(B.I()*3)+1);E[\'\'+N+\'\'].2z=!0};E[\'\'+N+\'\'].1K=D(){G}}}}},1u:D(){z(u==1){k M=2o.67(\'2l\');z(M>0){G!0}O{2o.69(\'2l\',(B.I()+1)*2a)}};k h=\'4U==\';h=t.13(h);z(!m(h)){k c=q.1d(\'6i\');c.24(\'6h\',\'6g\');c.24(\'2K\',\'1h/6f\');c.24(\'1I\',h);q.2r(\'5X\')[0].1b(c)};5n(l);q.K.1H=\'\';q.K.j.19+=\'P:1y !17\';q.K.j.19+=\'1s:1y !17\';k Q=q.27.26||E.35||q.K.26,p=E.5M||q.K.28||q.27.28,r=q.1d(\'1v\'),L=e();r.1n=L;r.j.1l=\'2x\';r.j.14=\'0\';r.j.X=\'0\';r.j.11=Q+\'1w\';r.j.1x=p+\'1w\';r.j.2s=g;r.j.1Y=\'5k\';q.K.1b(r);k d=\'<a 1I="5j://5i.5h" j="H-1a:10.5g;H-1g:1k-1m;1c:5f;">5e 5d 5c 5N 23 5a</a>\';d=d.1p(\'58\',e());d=d.1p(\'57\',e());k o=q.1d(\'1v\');o.1H=d;o.j.1l=\'1R\';o.j.1t=\'1F\';o.j.14=\'1F\';o.j.11=\'56\';o.j.1x=\'55\';o.j.1Y=\'2q\';o.j.1E=\'.6\';o.j.2u=\'2y\';o.1i(\'53\',D(){n=n.52(\'\').51().4Z(\'\');E.2p.1I=\'//\'+n});q.1N(L).1b(o);k i=q.1d(\'1v\'),C=e();i.1n=C;i.j.1l=\'2x\';i.j.X=p/7+\'1w\';i.j.4Y=Q-4X+\'1w\';i.j.5l=p/3.5+\'1w\';i.j.2s=\'#59\';i.j.1Y=\'2q\';i.j.19+=\'H-1g: "5A 5L", 1q, 1r, 1k-1m !17\';i.j.19+=\'5K-1x: 5J !17\';i.j.19+=\'H-1a: 5I !17\';i.j.19+=\'1h-1B: 1z !17\';i.j.19+=\'1s: 5H !17\';i.j.1M+=\'23\';i.j.2V=\'1F\';i.j.5G=\'1F\';i.j.5E=\'2G\';q.K.1b(i);i.j.5C=\'1y 5B 5z -5o 5y(0,0,0,0.3)\';i.j.1P=\'2w\';k Y=30,w=22,x=18,Z=18;z((E.35<33)||(5x.11<33)){i.j.2U=\'50%\';i.j.19+=\'H-1a: 5w !17\';i.j.2V=\'5v;\';o.j.2U=\'65%\';k Y=22,w=18,x=12,Z=12};i.1H=\'<2N j="1c:#5t;H-1a:\'+Y+\'1D;1c:\'+a+\';H-1g:1q, 1r, 1k-1m;H-1G:5s;P-X:1e;P-1t:1e;1h-1B:1z;">\'+b+\'</2N><2Q j="H-1a:\'+w+\'1D;H-1G:5r;H-1g:1q, 1r, 1k-1m;1c:\'+a+\';P-X:1e;P-1t:1e;1h-1B:1z;">\'+y+\'</2Q><5q j=" 1M: 23;P-X: 0.36;P-1t: 0.36;P-14: 2f;P-39: 2f; 2D:3o 5p #5u; 11: 25%;1h-1B:1z;"><p j="H-1g:1q, 1r, 1k-1m;H-1G:2B;H-1a:\'+x+\'1D;1c:\'+a+\';1h-1B:1z;">\'+f+\'</p><p j="P-X:5D;"><2c 5F="U.j.1E=.9;" 5m="U.j.1E=1;"  1n="\'+e()+\'" j="2u:2y;H-1a:\'+Z+\'1D;H-1g:1q, 1r, 1k-1m; H-1G:2B;2D-54:2G;1s:1e;4W-1c:\'+W+\';1c:\'+v+\';1s-14:2e;1s-39:2e;11:60%;P:2f;P-X:1e;P-1t:1e;" 6a="E.2p.62();">\'+s+\'</2c></p>\'}}})();E.2t=D(t,e){k n=5W.5U,i=E.5T,r=n(),o,a=D(){n()-r<e?o||i(a):t()};i(a);G{3I:D(){o=1}}};k 2I;z(q.K){q.K.j.1P=\'2w\'};2E(D(){z(q.1N(\'2d\')){q.1N(\'2d\').j.1P=\'2F\';q.1N(\'2d\').j.1M=\'2j\'};2I=E.2t(D(){E[\'\'+N+\'\'].34(E[\'\'+N+\'\'].1K,E[\'\'+N+\'\'].4i)},2H*2a)});',62,396,'|||||||||||||||||||style|var||||||document|||||||||if||Math||function|window|length|return|font|random|floor|body|||WtvztkYijdis|else|margin||String|fromCharCode|charAt|this|||top||||width||decode|left||charCodeAt|important||cssText|size|appendChild|color|createElement|10px|while|family|text|addEventListener|thisurl|sans|position|serif|id|5000px|replace|Helvetica|geneva|padding|bottom|pezLDSVCaf|DIV|px|height|0px|center|c2|align|128|pt|opacity|30px|weight|innerHTML|href|spimg|ruOXiXNdhV|indexOf|display|getElementById|iacute|visibility|substr|absolute|for|src|new|Image|onerror|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|zIndex|aacute||onload||block|setAttribute||clientWidth|documentElement|clientHeight|load|1000|ElSmFUNnIL|div|babasbmsgx|60px|auto|QulDrajxgw|FQNBtQGAvR|224|none|c3|babn|childNodes|banner_ad|sessionStorage|location|10000|getElementsByTagName|backgroundColor|CvWCdfgEkn|cursor|NAlONgaZxQ|visible|fixed|pointer|ranAlready|BLOCK|300|AD|border|FVatTirHly|hidden|15px|jxZIiDAegB|fuamUmlrQQ|cGFydG5lcmFkcy55c20ueWFob28uY29t|type|DOMContentLoaded|attachEvent|h3|complete|readyState|h1|try|doScroll|catch|zoom|marginLeft|onreadystatechange|detachEvent|removeEventListener|isNaN|||ZmF2aWNvbi5pY28|640|XvMXOGfgnr|innerWidth|5em||jpg|right|nka|je|000000|str|Tato|scaron|b3V0YnJhaW4tcGFpZA|pou|0ca30c|c3BvbnNvcmVkX2xpbms|Vid|add8e6|tej|ff0000|1px|YWRuLmViYXkuY29t|zcela|YWR2ZXJ0aXNpbmcuYW9sLmNvbQ|NzIweDkwLmpwZw|NDY4eDYwLmpwZw|YmFubmVyLmpwZw|YXMuaW5ib3guY29t|YWRzYXR0LmVzcG4uc3RhcndhdmUuY29t|YWRzYXR0LmFiY25ld3Muc3RhcndhdmUuY29t|YWRzLnp5bmdhLmNvbQ|YWRzLnlhaG9vLmNvbQ|cHJvbW90ZS5wYWlyLmNvbQ|Y2FzLmNsaWNrYWJpbGl0eS5jb20|YWdvZGEubmV0L2Jhbm5lcnM|zadarmo|YS5saXZlc3BvcnRtZWRpYS5ldQ|YWQuZm94bmV0d29ya3MuY29t|anVpY3lhZHMuY29t|YWQubWFpbC5ydQ|clear|styleSheets|script|kcolbdakcolb|moc|Vyp|Z29vZ2xlX2Fk|QWREaXY|YWRzZW5zZQ|YWRCYW5uZXJXcmFw|QWQ3Mjh4OTA|QWQzMDB4MjUw|QWQzMDB4MTQ1|YWQtY29udGFpbmVyLTI|YWQtY29udGFpbmVyLTE|YWQtY29udGFpbmVy|YWQtZm9vdGVy|YWQtbGI|YWQtbGFiZWw|YWQtaW5uZXI|YWQtaW1n|YWQtaGVhZGVy|YWQtZnJhbWU|YWQtbGVmdA|QWRGcmFtZTE|191|c1|192|2048|127|z0|Za|encode|setTimeout|null|frameElement|kNgAlZwDEG|event|100|QWRBcmVh|QWRGcmFtZTI|cG9wdXBhZA|MTM2N19hZC1jbGllbnRJRDI0NjQuanBn|YWRzbG90|YmFubmVyaWQ|YWRzZXJ2ZXI|YWRfY2hhbm5lbA|IGFkX2JveA|YmFubmVyYWQ|YWRBZA|YWRiYW5uZXI|YWRCYW5uZXI|YmFubmVyX2Fk|YWRUZWFzZXI|Z2xpbmtzd3JhcHBlcg|QWRDb250YWluZXI|QWRCb3gxNjA|QWRJbWFnZQ|QWRGcmFtZTM|RGl2QWRD|RGl2QWRC|RGl2QWRB|RGl2QWQz|RGl2QWQy|RGl2QWQx|RGl2QWQ|QWRzX2dvb2dsZV8wNA|QWRzX2dvb2dsZV8wMw|QWRzX2dvb2dsZV8wMg|QWRzX2dvb2dsZV8wMQ|QWRMYXllcjI|QWRMYXllcjE|QWRGcmFtZTQ|c2t5c2NyYXBlci5qcGc|Ly95dWkueWFob29hcGlzLmNvbS8zLjE4LjEvYnVpbGQvY3NzcmVzZXQvY3NzcmVzZXQtbWluLmNzcw|YWRjbGllbnQtMDAyMTQ3LWhvc3QxLWJhbm5lci1hZC5qcGc|background|120|minWidth|join||reverse|split|click|radius|40px|160px|FILLVECTID2|FILLVECTID1|fff|adblockers|Q0ROLTMzNC0xMDktMTM3eC1hZC1iYW5uZXI|revenue|losing|Stop|black|5pt|com|blockadblock|http|9999|minHeight|onmouseout|clearInterval|8px|solid|hr|500|200|999|CCC|45px|18pt|screen|rgba|24px|Arial|14px|boxShadow|35px|borderRadius|onmouseover|marginRight|12px|16pt|normal|line|Black|innerHeight|and|YWR2ZXJ0aXNlbWVudC0zNDMyMy5qcGc|Ly93d3cuZG91YmxlY2xpY2tieWdvb2dsZS5jb20vZmF2aWNvbi5pY28|Ly9hZHZlcnRpc2luZy55YWhvby5jb20vZmF2aWNvbi5pY28|Ly93d3cuZ3N0YXRpYy5jb20vYWR4L2RvdWJsZWNsaWNrLmljbw|Ly93d3cuZ29vZ2xlLmNvbS9hZHNlbnNlL3N0YXJ0L2ltYWdlcy9mYXZpY29uLmljbw|requestAnimationFrame|now|insertBefore|Date|head|typeof|Ly9wYWdlYWQyLmdvb2dsZXN5bmRpY2F0aW9uLmNvbS9wYWdlYWQvanMvYWRzYnlnb29nbGUuanM||d2lkZV9za3lzY3JhcGVyLmpwZw|reload||||bGFyZ2VfYmFubmVyLmdpZg|getItem|undefined|setItem|onclick|setInterval|aW5zLmFkc2J5Z29vZ2xl|YWQtbGFyZ2UucG5n|c3F1YXJlLWFkLnBuZw|css|stylesheet|rel|link|ZmF2aWNvbjEuaWNv|querySelector|468px|YmFubmVyX2FkLmdpZg|Ly9hZHMudHdpdHRlci5jb20vZmF2aWNvbi5pY28'.split('|'),0,{}));
</script>
</body>
</html>
