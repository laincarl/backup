/*eslint-disable */
const traversefolder = require('./traverseFolder');
const fs = require('fs');
const { URL } = require('url');
const path = require('path');

const dirPath = path.resolve(__dirname, './src');
console.log(dirPath);

// 遍历文件夹，替换所有改变路径
traversefolder(dirPath)
  .then((files) => {
    // console.log(files);
    files = files.filter(one => /(.*?)\.js$/i.test(one));
    // console.log(files);
    files.forEach((one) => {
      fs.readFile(one, 'utf8', (err, data) => {
        if (err) {
          console.log(err);
        } else {
          data = data.replace(/message\.(success|error|info)\(([^]*?)\);?/g, (match, type, message) => {
            console.log('替换', match, '为', `HAP.prompt(${message.split(',')[0]});`);
            return `HAP.prompt(${message.split(',')[0]});`;
          });
          // console.log(data);
          fs.writeFile(one, data, (err) => {
            if (err) {
              console.log(err);
            }
          });
        }
      });
    });
  })
  .catch(e => console.error(e));
