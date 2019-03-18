// pages/goods/goodsList.js
const util = require('../../utils/util.js');
const api = require('../../config/api.js');
const app = getApp()
Page({
  data: {
    goodsList: [],
    page: 1,
    size: 10, 
    height: '',
  },
  getGoodsList: function() {
    let that = this;
    util.request(api.GoodsListNoCategory,{
      page: that.data.page,
      size: that.data.size
    }).then(function (res) {
      if (res.code == 200) {
        that.setData({
          goodsList: res.data,
        });
      }
    });
  },
  lower() {
    let that = this;
    var result = this.data.goodsList;
    that.data.page = that.data.page + 1,
    util.request(api.GoodsListNoCategory, {
      page: that.data.page,
      size: that.data.size
    }).then(function (res) {
      if (res.code == 200) {
        wx.showLoading({ //期间为了显示效果可以添加一个过度的弹出框提示“加载中”  
          title: '加载中',
          icon: 'loading',
        });
        setTimeout(() => {
          that.setData({
            goodsList: result.concat(res.data)
          });
          wx.hideLoading();
        }, 300)
      }
    });
  },
  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {
    this.getGoodsList();
    wx.getSystemInfo({
      success: (res) => {
        this.setData({
          height: res.windowHeight
        })
      }
    });
  },

  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function () {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function () {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function () {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function () {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function () {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function () {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {

  }
})