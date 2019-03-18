var util = require('../../utils/util.js');
var api = require('../../config/api.js');

Page({
    data: {
        // text:"这是一个页面"
      navList: [],
        goodsList: [],
        id: 0,
        currentCategory: {},
        scrollLeft: 0,
        scrollTop: 0,
        scrollHeight: 0,
        page: 1,
        size: 8,
      categoryId:0
    },
    onLoad: function(options) {
        // 页面初始化 options为页面跳转所带来的参数
        var that = this;
      
        // if (options.id) {
        //   console.log(options.id)
        //     that.setData({
        //         id: parseInt(options.id)
        //     });
        // }
        wx.getSystemInfo({
            success: function(res) {
                that.setData({
                    scrollHeight: res.windowHeight
                });
            }
        });
        this.getCategoryInfo();

    },
    getCategoryInfo: function() {
        let that = this;
      util.request(api.CatalogList, {
            })
            .then(function(res) {
              console.log(res)
                if (res.code === 200) {
                  let ceshi=
                    that.setData({
                        // navList: res.data.brotherCategory,
                      navList: res.data.categoryList,
                        currentCategory: res.data.currentCategory
                    });

                    //nav位置
                    let currentIndex = 0;
                    let navListCount = that.data.navList.length;
                    for (let i = 0; i < navListCount; i++) {
                        currentIndex += 1;
                        if (that.data.navList[i].id == that.data.id) {
                            break;
                        }
                    }
                    // if (currentIndex > navListCount / 2 && navListCount > 5) {
                    //     that.setData({
                    //         scrollLeft: currentIndex * 60
                    //     });
                    // }
                    that.getGoodsList();

                } else {
                    //显示错误信息
                }

            });
    },
  
    onReady: function() {
        // 页面渲染完成
    },
    onShow: function() {
        // 页面显示
        // console.log(1);
    },
    onHide: function() {
        // 页面隐藏
    },
    getGoodsList: function() {
        var that = this;
       
        util.request(api.GoodsList, {
                categoryId: that.data.id,
                page: that.data.page,
                size: that.data.size
            })
            .then(function(res) {


              wx.showLoading({ //期间为了显示效果可以添加一个过度的弹出框提示“加载中”  
                title: '加载中',
                icon: 'loading',
              });
              setTimeout(() => {
                that.setData({
                  goodsList: res.data,
                });
                wx.hideLoading();
              }, 300)

                // that.setData({
                //     goodsList: res.data,
                // });
            });
    },
  lower() {
    let that = this;
    var result = this.data.goodsList;
    that.data.page = that.data.page + 1,
    console.log(1111111111111)
      util.request(api.GoodsList, {
        categoryId: that.data.id,
        page: that.data.page,
        size: that.data.size
      }).then(function (res) {
        if (res.code == 200) {
          // if(res.data==""){
          //   console.log("没了")
          // }else{
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
          // }
         

        }
      });
  },

    onUnload: function() {
        // 页面关闭
     
    },
    switchCate: function(event) {
        if (this.data.id == event.currentTarget.dataset.id) {
            return false;
        }
        var that = this;
        var clientX = event.detail.x;
        var currentTarget = event.currentTarget;
        if (clientX < 60) {
            that.setData({
                scrollLeft: currentTarget.offsetLeft - 60
            });
        } else if (clientX > 330) {
            that.setData({
                scrollLeft: currentTarget.offsetLeft
            });
        }
        this.setData({
          scrollTop: 0,
            id: event.currentTarget.dataset.id,
          page:1,
          goodsList:[]
        });
        this.getCategoryInfo();
    }
})