const sharp = require('sharp')
const PDF2Pic = require("pdf2pic");
const fs = require('fs');

// const pdf2pic = new PDF2Pic({
//     density: 700,           // output pixels per inch
//     savename: "1",   // output file name
//     savedir: "./images",    // output file location
//     format: "png",          // output file format
//     size: "800x800"
// })

// pdf2pic.convert("demo.pdf").then((res) => {
//     console.log('convert thanh cong');
//     let originalImage = '/home/vuongdh/Code/converttopicture/images/1_1.png';

//     // file name for cropped image
//     let outputImage = 'croppedImage.png';

//     sharp(originalImage).extract({ width: 600, height: 150, left: 0, top: 50, }).toFile(outputImage)
//         .then(function (new_file_info) {
//             console.log("Image cropped and saved");
//         })
//         .catch(function (err) {
//             console.log(err)
//             console.log("An error occured");
//         });
// })




fs.readFile('test.json', (err, data) => {
    if(err) throw err;
    let t = JSON.parse(data);
    console.log(t.fullTextAnnotation.text)
})
