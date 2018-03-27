import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import "react-image-gallery/styles/css/image-gallery.css";
import registerServiceWorker from './registerServiceWorker';
import ImageGallery from 'react-image-gallery';
import './iconfont/iconfont.css'
import GallerySwiper from 'react-gallery-swiper';

class App extends React.Component {
    handleImageLoad = (event) => {
        console.log('Image loaded ', event.target);
    };

    render = () => {
        const images = [{
            original: 'http://c7.staticflickr.com/4/3868/18982735806_b80b024040_h.jpg',
            thumbnail: 'http://c7.staticflickr.com/4/3868/18982735806_cd60bcdb69_n.jpg',
            originalClass: 'featured-slide',
            thumbnailClass: 'featured-thumb',
            originalAlt: 'I am a featured image',
            thumbnailAlt: 'I am the thumbnail for the featured image',
        }, {
            original: 'http://c5.staticflickr.com/1/292/19003529492_214a7e3777_h.jpg',
            thumbnail: 'http://c5.staticflickr.com/1/292/19003529492_226031f2c1_n.jpg'
        }, {
            original: 'http://c6.staticflickr.com/4/3802/19009038565_c197845618_h.jpg',
            thumbnail: 'http://c6.staticflickr.com/4/3802/19009038565_17e2e21b22_n.jpg'
        }];

        return (
            <GallerySwiper
                ref={i => this._gallerySwiper = i}
                images={images}
                onImageLoad={this.handleImageLoad}
                />
        );
    };
}
class MyComponent extends React.Component {

  handleImageLoad(event) {
    console.log('Image loaded ', event.target)
  }

  render() {

    const images = [
      {
        original: 'http://lorempixel.com/1000/600/nature/1/',
        thumbnail: 'http://lorempixel.com/250/150/nature/1/',
      },
      {
        original: 'http://lorempixel.com/1000/600/nature/2/',
        thumbnail: 'http://lorempixel.com/250/150/nature/2/'
      },
      {
        original: 'http://lorempixel.com/1000/600/nature/3/',
        thumbnail: 'http://lorempixel.com/250/150/nature/3/'
      }
    ]

    return (
      <ImageGallery
        items={images}
        slideInterval={2000}
        onImageLoad={this.handleImageLoad}
        lazyLoad={true}/>
    );
  }

}
ReactDOM.render(<App />, document.getElementById('root'));
registerServiceWorker();
