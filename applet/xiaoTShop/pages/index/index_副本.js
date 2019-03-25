const util = require('../../utils/util.js');
const api = require('../../config/api.js');
const user = require('../../services/user.js');
//获取应用实例
const app = getApp()
Page({
    data: {
        swiperCurrent: 0,// ++
        autoplay: 1,
        interval: 6e3,// ++
        newGoods: [],
        hotGoods: [],
        duration: 1000,
        topics: [],
        brands: [],
        floorGoods: [],
        carouselInfo: [],
        wxlogin: 0, // ++ 是否登陆
        hovercoupons: 1, // ++是否移动到优惠券
        specialList: [],
      height_num:[]
    },
    
    onSearchClick() {
      wx.navigateTo({
        url: `/pages/search/search`
      })
    },


    onShareAppMessage: function() {
        return {
            title: 'tungnaro',
          desc: 'tungnaro微商城',
            path: '/pages/index/index'
        }
    },
    swiperchange: function(x) {
        let that = this;
        that.setData({
            swiperCurrent: x.detail.current,
        });
    },
    getIndexData: function() {
        let that = this;
        util.request(api.IndexUrl).then(function(res) {
            if (res.code == 200) {
                var carouselInfo=''; 
              var height_num=""
                // if(res.data.itemList[2] && res.data.itemList[2].item_type=='adv'){
                //     carouselInfo = res.data.itemList[2].carousels;
                // }
              // console.log(res.data.itemList)
              // console.log(res.data.navList)
                that.setData({
                    itemList: res.data.itemList,
                    carouselInfo: carouselInfo,
                    navList: res.data.navList
                });
            }
        });
    },
    onLoad: function(options) {
      console.log(app)
        let isIphoneX = app.globalData.isIphoneX;
        this.setData({
          isIphoneX: isIphoneX
        })
        this.getIndexData();  
    },
    onReady: function() {
        // 页面渲染完成
    },
    onShow: function() {
        var token = wx.getStorageSync('token');
        if(!token){
            return false;
        }
        this.setData({
            wxlogin: 1,
        });
        // 页面显示
    },
    onHide: function() {
        // 页面隐藏
    },
    onUnload: function() {
        // 页面关闭
    },
    navTo:function(x){
        var xurl = x.currentTarget.dataset.url
        wx.reLaunch({
            url: xurl
        });
    },
    specialTo:function(x){
        var carousel_type = x.currentTarget.dataset.carousel_type;
        var carousel_type_data = x.currentTarget.dataset.carousel_type_data;
        var xurl = '';
        switch(carousel_type)
        {
            case 'goods':
                xurl = '/pages/goods/goods?id=' + carousel_type_data;
                break;
            case 'special':
                xurl = '/pages/topicDetail/topicDetail?id=' + carousel_type_data;
                break;
            case 'link':
                xurl = carousel_type_data;
                break;
            default:
            return;
        }
        wx.navigateTo({
            url: xurl
        });
    },
    tapSales: function(x,isTab) {
        var xurl = x.currentTarget.dataset.url
        wx.navigateTo({
            url: xurl
        });
    },
    toDetailsTap: function(x) {
        wx.navigateTo({
            url: '/pages/goods/goods?id=' + x.currentTarget.dataset.id
        });
    },
    toTopic: function(x) {
        wx.navigateTo({
            url: '/pages/topicDetail/topicDetail?id=' + x.currentTarget.dataset.id
        });
    },
    jump: function(event) {
        var jurl = event.currentTarget.dataset.url
        wx.reLaunch({
            url: jurl,
        })
    },




  userlogin: function (e) {
    if (!e.detail.userInfo) {
      // 用户拒绝
      return;
    } else {
      //用户允许
      wx.reLaunch({
        url: '/pages/index/index'
      })
    }

  },
})