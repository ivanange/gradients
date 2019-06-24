with  open("gradients.txt") as text :
    line="";
    line += text.readline();
    line = line.strip();
    content ="";
    while(line) :
        
        if (line or line in ['\n', '\r\n'] ):
            if(";" in line) :
                line = line.strip().replace(";", "");
                content += "<div class='gradient' clip-data=\""  + line + "\" style = \" background-image:" + line + ";\" ><span   class='info full' >Fullscreen</span> </div>";
                line ="";
        newline = text.readline();
        if( not(newline) ): break;
        line += newline;
        
        
with open("content.php", "w") as htmlfile :
        htmlfile.write(content);