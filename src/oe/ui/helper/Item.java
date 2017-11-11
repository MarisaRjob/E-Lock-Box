package oe.ui.helper;

import javafx.scene.control.Hyperlink;

public class Item {
    private String linkName;
    private Hyperlink hyperlink;

    public Item(String linkName, String linkUrl) {
        this.linkName = linkName;
        this.hyperlink = new Hyperlink(linkUrl);
    }

    public String getLinkName() {
        return linkName;
    }

    public void setLinkName(String linkName) {
        this.linkName = linkName;
    }

    public Hyperlink getHyperlink() {
        return hyperlink;
    }

    public void setHyperlink(String linkUrl) {
        this.hyperlink = new Hyperlink(linkUrl);
    }
}

