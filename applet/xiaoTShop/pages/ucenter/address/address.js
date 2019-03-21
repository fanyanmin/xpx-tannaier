var util = require('../../../utils/util.js');
var api = require('../../../config/api.js');
var app = getApp();

Page({
  data: {
    addressList: [],
  },
  onLoad: function(options) {
    // 页面初始化 options为页面跳转所带来的参数
    let isIphoneX = app.globalData.isIphoneX;
    this.setData({
      isIphoneX: isIphoneX
    })
    this.getAddressList();
  },
  onReady: function() {
    // 页面渲染完成
  },
  onShow: function() {
    // 页面显示

  },
  getAddressList() {
    let that = this;
    util.request(api.AddressList).then(function(res) {
      if (res.code == 200) {
        that.setData({
          addressList: res.data
        });
      }
    });
  },
  addressAddOrUpdate(event) {
    // console.log(event)
    wx.navigateTo({
      url: '/pages/ucenter/addressAdd/addressAdd?id=' + event.currentTarget.dataset.addressId
    })
  },
  deleteAddress(event) {
    // console.log(event)
    let that = this;
    wx.showModal({
      title: '',
      content: '确定要删除地址？',
      success: function(res) {
        if (res.confirm) {
          let addressId = event
          // .target.dataset.addressId;
          util.request(api.AddressDelete, {
            id: addressId
          }, 'POST').then(function(res) {
            if (res.code == 200) {
              that.getAddressList();
            }
          });
          console.log('用户点击确定')
        }
      }
    })
    return false;

  },
  onHide: function() {
    // 页面隐藏
  },
  onUnload: function() {
    // 页面关闭
  },
  touchStart: function (e) {
    // console.log(e)
    let that = this;
    that.setData({
      touch_start: e.timeStamp
    })
    // console.log(e.timeStamp + '- touch-start')
  },
  //按下事件结束  
  touchEnd: function (e) {
    let that = this;
    that.setData({
      touch_end: e.timeStamp
    })
    // console.log(e.timeStamp + '- touch-end')
  },
  selectTap:function(event){
    // console.log(event)
    let that = this;
    let goodsId = event.currentTarget.dataset.id;
    // console.log(event.currentTarget.dataset.id)
    //触摸时间距离页面打开的毫秒数  
    var touchTime = that.data.touch_end - that.data.touch_start;
    // console.log(touchTime);
    //如果按下时间大于350为长按  
    if (touchTime > 350) {
      that.deleteAddress(goodsId)
    } 
  }

})