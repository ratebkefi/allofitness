$(function(){
    $("#typed").typed({
        // strings: ["Typed.js is a <strong>jQuery</strong> plugin.", "It <em>types</em> out sentences.", "And then deletes them.", "Try it out!"],
        stringsElement: $('#typed-strings'),
        typeSpeed: 100,
        backDelay: 1000,
        loop: true,
        contentType: 'html', // or text
        // defaults to false for infinite loop
        loopCount: false
    });
    $(".reset").click(function(){
        $("#typed").typed('reset');
    });
});

$(function(){
    $("#typed").typed({
        strings: ["First sentence.", "Second sentence."],
        typeSpeed: 0
    });
});